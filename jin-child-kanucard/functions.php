<?php
/**
 * JIN Child - Kanucard LP functions
 *
 * @package JIN_Child_Kanucard
 */

// 子テーマのバージョン
define( 'JIN_CHILD_KANUCARD_VERSION', '1.0.0' );

/**
 * 親テーマと子テーマのスタイルを読み込み
 */
function jin_child_kanucard_enqueue_styles() {
    // 親テーマのスタイル
    wp_enqueue_style(
        'jin-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( 'jin' )->get( 'Version' )
    );

    // 子テーマのスタイル
    wp_enqueue_style(
        'jin-child-style',
        get_stylesheet_uri(),
        array( 'jin-parent-style' ),
        JIN_CHILD_KANUCARD_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'jin_child_kanucard_enqueue_styles' );

/**
 * LP専用のスタイルとスクリプトを読み込み
 */
function jin_child_kanucard_lp_assets() {
    // LPテンプレートが使用されている場合のみ読み込み
    if ( is_page_template( 'template-lp.php' ) ) {
        // LP専用CSS
        wp_enqueue_style(
            'kanucard-lp-style',
            get_stylesheet_directory_uri() . '/assets/css/lp.css',
            array(),
            JIN_CHILD_KANUCARD_VERSION
        );

        // AOS アニメーションライブラリ
        wp_enqueue_style(
            'aos',
            'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',
            array(),
            '2.3.4'
        );

        // Font Awesome
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
            array(),
            '6.4.0'
        );

        // LP専用JavaScript
        wp_enqueue_script(
            'kanucard-lp-script',
            get_stylesheet_directory_uri() . '/assets/js/lp.js',
            array( 'jquery' ),
            JIN_CHILD_KANUCARD_VERSION,
            true
        );

        // AOS JavaScript
        wp_enqueue_script(
            'aos',
            'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',
            array(),
            '2.3.4',
            true
        );

        // Ajax URL をJSに渡す
        wp_localize_script( 'kanucard-lp-script', 'kanucard_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'kanucard_contact_form' ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'jin_child_kanucard_lp_assets' );

/**
 * コンタクトフォーム処理（Ajax）
 */
function jin_child_kanucard_process_contact_form() {
    // Nonceチェック
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'kanucard_contact_form' ) ) {
        wp_die( 'Security check failed' );
    }

    // データの取得とサニタイズ
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    // メール送信
    $to      = get_option( 'admin_email' );
    $subject = 'New Contact Form Submission from ' . $name;
    $body    = "Name: $name\n\nEmail: $email\n\nMessage:\n$message";
    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( 'Thank you for your message!' );
    } else {
        wp_send_json_error( 'Failed to send message. Please try again.' );
    }
}
add_action( 'wp_ajax_kanucard_contact', 'jin_child_kanucard_process_contact_form' );
add_action( 'wp_ajax_nopriv_kanucard_contact', 'jin_child_kanucard_process_contact_form' );

/**
 * LPテンプレートでJINのヘッダー・フッターを非表示にするオプション
 */
function jin_child_kanucard_body_class( $classes ) {
    if ( is_page_template( 'template-lp.php' ) ) {
        $classes[] = 'kanucard-lp-page';
    }
    return $classes;
}
add_filter( 'body_class', 'jin_child_kanucard_body_class' );

/**
 * PSA LP 口コミ管理画面
 */
function psa_lp_reviews_admin_menu() {
    // 未確認の口コミ数を取得
    $reviews = get_option( 'psa_lp_reviews', array() );
    $unread_count = 0;
    foreach ( $reviews as $review ) {
        if ( empty( $review['read'] ) ) {
            $unread_count++;
        }
    }

    // バッジ付きメニュータイトル
    $menu_title = 'PSA LP 口コミ';
    if ( $unread_count > 0 ) {
        $menu_title .= sprintf( ' <span class="awaiting-mod">%d</span>', $unread_count );
    }

    add_menu_page(
        'PSA LP 口コミ管理',
        $menu_title,
        'manage_options',
        'psa-lp-reviews',
        'psa_lp_reviews_admin_page',
        'dashicons-star-filled',
        30
    );
}
add_action( 'admin_menu', 'psa_lp_reviews_admin_menu' );

function psa_lp_reviews_admin_page() {
    $reviews = get_option( 'psa_lp_reviews', array() );

    // 口コミ削除処理
    if ( isset( $_GET['delete_review'] ) && isset( $_GET['_wpnonce'] ) ) {
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'delete_review_' . $_GET['delete_review'] ) ) {
            $reviews = array_filter( $reviews, function( $r ) {
                return $r['id'] !== $_GET['delete_review'];
            });
            update_option( 'psa_lp_reviews', array_values( $reviews ) );
            $reviews = array_values( $reviews );
            echo '<div class="notice notice-success"><p>口コミを削除しました。</p></div>';
        }
    }

    // 確認済みにする処理
    if ( isset( $_GET['mark_read'] ) && isset( $_GET['_wpnonce'] ) ) {
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'mark_read_' . $_GET['mark_read'] ) ) {
            foreach ( $reviews as &$r ) {
                if ( $r['id'] === $_GET['mark_read'] ) {
                    $r['read'] = true;
                    break;
                }
            }
            unset( $r );
            update_option( 'psa_lp_reviews', $reviews );
            echo '<div class="notice notice-success"><p>確認済みにしました。</p></div>';
        }
    }

    // 全て確認済みにする処理
    if ( isset( $_GET['mark_all_read'] ) && isset( $_GET['_wpnonce'] ) ) {
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'mark_all_read' ) ) {
            foreach ( $reviews as &$r ) {
                $r['read'] = true;
            }
            unset( $r );
            update_option( 'psa_lp_reviews', $reviews );
            echo '<div class="notice notice-success"><p>全て確認済みにしました。</p></div>';
        }
    }

    // 未確認件数をカウント
    $unread_count = 0;
    foreach ( $reviews as $review ) {
        if ( empty( $review['read'] ) ) {
            $unread_count++;
        }
    }

    $reviews_display = array_reverse( $reviews ); // 新しい順に表示
    ?>
    <style>
        .psa-review-unread { background-color: #fff8e5 !important; }
        .psa-review-unread td { border-left: 3px solid #f0c14b; }
        .psa-badge-new { background: #d63638; color: #fff; padding: 2px 6px; border-radius: 3px; font-size: 11px; margin-left: 5px; }
    </style>
    <div class="wrap">
        <h1>PSA LP 口コミ管理</h1>
        <p>
            投稿された口コミ一覧です。（<?php echo count( $reviews ); ?>件）
            <?php if ( $unread_count > 0 ): ?>
                <span class="psa-badge-new">未確認: <?php echo $unread_count; ?>件</span>
                <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&mark_all_read=1' ), 'mark_all_read' ); ?>"
                   class="button button-secondary" style="margin-left: 10px;">全て確認済みにする</a>
            <?php endif; ?>
        </p>

        <?php if ( empty( $reviews ) ): ?>
            <p>まだ口コミはありません。</p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th style="width: 40px;">状態</th>
                        <th style="width: 120px;">投稿日時</th>
                        <th style="width: 100px;">お名前</th>
                        <th style="width: 80px;">評価</th>
                        <th>メッセージ</th>
                        <th style="width: 150px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $reviews_display as $review ): ?>
                        <?php $is_unread = empty( $review['read'] ); ?>
                        <tr class="<?php echo $is_unread ? 'psa-review-unread' : ''; ?>">
                            <td>
                                <?php if ( $is_unread ): ?>
                                    <span class="psa-badge-new">NEW</span>
                                <?php else: ?>
                                    <span style="color: #999;">✓</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo esc_html( $review['date'] ); ?></td>
                            <td><?php echo esc_html( $review['name'] ); ?></td>
                            <td><?php echo str_repeat( '★', $review['rating'] ) . str_repeat( '☆', 5 - $review['rating'] ); ?></td>
                            <td><?php echo nl2br( esc_html( $review['message'] ) ); ?></td>
                            <td>
                                <?php if ( $is_unread ): ?>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&mark_read=' . $review['id'] ), 'mark_read_' . $review['id'] ); ?>"
                                       class="button button-small button-primary">確認済み</a>
                                <?php endif; ?>
                                <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&delete_review=' . $review['id'] ), 'delete_review_' . $review['id'] ); ?>"
                                   onclick="return confirm('この口コミを削除しますか？');"
                                   class="button button-small">削除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}