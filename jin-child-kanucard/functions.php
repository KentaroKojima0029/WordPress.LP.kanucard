<?php
/**
 * JIN Child - Kanucard LP functions
 *
 * @package JIN_Child_Kanucard
 */

// 子テーマのバージョン
define( 'JIN_CHILD_KANUCARD_VERSION', '1.0.0' );

/**
 * 業務委託募集ページを自動作成
 */
function kanucard_create_recruitment_page() {
    // 既に作成済みかチェック
    if ( get_option( 'kanucard_recruitment_page_created' ) ) {
        return;
    }

    // 同名のページが存在するかチェック
    $existing_page = get_page_by_path( 'recruitment' );
    if ( $existing_page ) {
        update_option( 'kanucard_recruitment_page_created', true );
        return;
    }

    // 固定ページを作成
    $page_data = array(
        'post_title'     => '業務委託パートナー募集',
        'post_name'      => 'recruitment',
        'post_content'   => '',
        'post_status'    => 'publish',
        'post_type'      => 'page',
        'post_author'    => 1,
        'page_template'  => 'template-recruitment.php',
    );

    $page_id = wp_insert_post( $page_data );

    if ( $page_id && ! is_wp_error( $page_id ) ) {
        update_option( 'kanucard_recruitment_page_created', true );
        update_option( 'kanucard_recruitment_page_id', $page_id );
    }
}
add_action( 'after_switch_theme', 'kanucard_create_recruitment_page' );
add_action( 'init', 'kanucard_create_recruitment_page' );

/**
 * ロゴをグラデーションスタイルに変更（PSA LPと同じ）
 */
function kanucard_brand_logo_styles() {
    ?>
    <style>
    /* Brand Logo - Gradient Style (PSA LP同様) */
    #site-info,
    #site-info .tn-logo-size {
        display: flex !important;
        align-items: center !important;
    }
    #site-info a,
    #site-info .tn-logo-size a,
    .tn-logo-size a {
        font-size: 0 !important;
        text-decoration: none !important;
        position: relative !important;
        display: inline-block !important;
    }
    #site-info a::after,
    #site-info .tn-logo-size a::after,
    .tn-logo-size a::after {
        content: 'kanucard' !important;
        font-size: 1.5rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.5px !important;
        background: linear-gradient(135deg, #8b5cf6, #ec4899, #ef4444, #fbbf24, #8b5cf6) !important;
        background-size: 200% auto !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        background-clip: text !important;
        filter: drop-shadow(0 0 8px rgba(139, 92, 246, 0.4)) !important;
        animation: brandGradientFlow 5s ease infinite, brandGlowPulse 3s ease-in-out infinite !important;
    }
    #site-info a:hover::after,
    .tn-logo-size a:hover::after {
        filter: drop-shadow(0 0 15px rgba(139, 92, 246, 0.7)) !important;
    }
    @keyframes brandGradientFlow {
        0%, 100% { background-position: 0% center; }
        50% { background-position: 100% center; }
    }
    @keyframes brandGlowPulse {
        0%, 100% { filter: drop-shadow(0 0 8px rgba(139, 92, 246, 0.4)); }
        50% { filter: drop-shadow(0 0 12px rgba(139, 92, 246, 0.6)); }
    }
    @media (max-width: 768px) {
        #site-info a::after,
        .tn-logo-size a::after {
            font-size: 1.2rem !important;
        }
    }
    </style>
    <?php
}
add_action( 'wp_head', 'kanucard_brand_logo_styles', 999 );

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
    // 削除処理（投稿を完全削除）
    if ( isset( $_GET['delete_review'] ) && isset( $_GET['_wpnonce'] ) ) {
        $rid = intval( $_GET['delete_review'] );
        if ( $rid && wp_verify_nonce( $_GET['_wpnonce'], 'delete_review_' . $rid ) ) {
            wp_delete_post( $rid, true );
            echo '<div class="notice notice-success"><p>口コミを削除しました。</p></div>';
        }
    }

    // 確認済みにする
    if ( isset( $_GET['mark_read'] ) && isset( $_GET['_wpnonce'] ) ) {
        $rid = intval( $_GET['mark_read'] );
        if ( $rid && wp_verify_nonce( $_GET['_wpnonce'], 'mark_read_' . $rid ) ) {
            update_post_meta( $rid, '_psa_review_read', 1 );
            echo '<div class="notice notice-success"><p>確認済みにしました。</p></div>';
        }
    }

    // 全て確認済みにする
    if ( isset( $_GET['mark_all_read'] ) && isset( $_GET['_wpnonce'] ) ) {
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'mark_all_read' ) ) {
            $all = kanucard_get_reviews();
            foreach ( $all as $rv ) {
                update_post_meta( $rv['id'], '_psa_review_read', 1 );
            }
            echo '<div class="notice notice-success"><p>全て確認済みにしました。</p></div>';
        }
    }

    // 口コミ承認（LPに表示）→ 投稿ステータスを publish に
    if ( isset( $_GET['approve_review'] ) && isset( $_GET['_wpnonce'] ) ) {
        $rid = intval( $_GET['approve_review'] );
        if ( $rid && wp_verify_nonce( $_GET['_wpnonce'], 'approve_review_' . $rid ) ) {
            wp_update_post( array( 'ID' => $rid, 'post_status' => 'publish' ) );
            update_post_meta( $rid, '_psa_review_read', 1 );
            echo '<div class="notice notice-success"><p>口コミを承認しました。LPに表示されます。</p></div>';
        }
    }

    // 口コミ非公開（LPから非表示）→ 投稿ステータスを draft に
    if ( isset( $_GET['unapprove_review'] ) && isset( $_GET['_wpnonce'] ) ) {
        $rid = intval( $_GET['unapprove_review'] );
        if ( $rid && wp_verify_nonce( $_GET['_wpnonce'], 'unapprove_review_' . $rid ) ) {
            wp_update_post( array( 'ID' => $rid, 'post_status' => 'draft' ) );
            echo '<div class="notice notice-success"><p>口コミを非公開にしました。</p></div>';
        }
    }

    // 「LPに画像を表示」のトグル
    if ( isset( $_GET['toggle_image'] ) && isset( $_GET['_wpnonce'] ) ) {
        $rid = intval( $_GET['toggle_image'] );
        if ( $rid && wp_verify_nonce( $_GET['_wpnonce'], 'toggle_image_' . $rid ) ) {
            $cur = (bool) get_post_meta( $rid, '_psa_review_show_image', true );
            update_post_meta( $rid, '_psa_review_show_image', $cur ? 0 : 1 );
            echo '<div class="notice notice-success"><p>画像の表示設定を更新しました。</p></div>';
        }
    }

    // 編集保存（お名前・メッセージ）
    if ( isset( $_POST['save_review'] ) && isset( $_POST['_wpnonce'] ) && isset( $_POST['review_id'] ) ) {
        $rid = intval( $_POST['review_id'] );
        if ( $rid && wp_verify_nonce( $_POST['_wpnonce'], 'save_review_' . $rid ) ) {
            $new_name    = sanitize_text_field( wp_unslash( $_POST['review_name'] ?? '' ) );
            $new_message = sanitize_textarea_field( wp_unslash( $_POST['review_message'] ?? '' ) );
            update_post_meta( $rid, '_psa_review_name', $new_name );
            update_post_meta( $rid, '_psa_review_message', $new_message );
            echo '<div class="notice notice-success"><p>口コミを更新しました。</p></div>';
        }
    }

    // 一覧データを取得（投稿ベース）
    $reviews_display = kanucard_get_reviews();

    $unread_count = 0;
    foreach ( $reviews_display as $review ) {
        if ( empty( $review['read'] ) ) { $unread_count++; }
    }

    $reviews = $reviews_display; // 既存のテンプレ参照を保つため別名でも参照可
    $editing_id = isset( $_GET['edit_review'] ) ? intval( $_GET['edit_review'] ) : 0;
    ?>
    <style>
        .psa-review-unread { background-color: #fff8e5 !important; }
        .psa-review-unread td { border-left: 3px solid #f0c14b; }
        .psa-badge-new { background: #d63638; color: #fff; padding: 2px 6px; border-radius: 3px; font-size: 11px; margin-left: 5px; }
        .psa-badge-approved { background: #00a32a; color: #fff; padding: 2px 6px; border-radius: 3px; font-size: 11px; }
        .psa-badge-pending { background: #996800; color: #fff; padding: 2px 6px; border-radius: 3px; font-size: 11px; }
        .psa-edit-row { background: #f0f6fc !important; }
        .psa-edit-row td { padding: 12px !important; }
        .psa-edit-row input[type="text"] { width: 100%; }
        .psa-edit-row textarea { width: 100%; min-height: 80px; }
        .psa-review-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; display: block; }
        .psa-review-thumb-link { display: inline-block; }
        .psa-badge-image-on { background: #2271b1; color: #fff; padding: 2px 6px; border-radius: 3px; font-size: 11px; }
        .psa-badge-image-off { background: #8c8f94; color: #fff; padding: 2px 6px; border-radius: 3px; font-size: 11px; }
    </style>
    <div class="wrap">
        <h1>PSA LP 口コミ管理</h1>

        <?php
        // ===== 診断ログ表示（デバッグ用・安定後は削除） =====
        $debug_history = get_option( 'psa_lp_reviews_debug', array() );
        if ( isset( $_GET['clear_review_debug'] ) && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'clear_review_debug' ) ) {
            delete_option( 'psa_lp_reviews_debug' );
            $debug_history = array();
            echo '<div class="notice notice-success"><p>診断ログをクリアしました。</p></div>';
        }
        if ( ! empty( $debug_history ) ) :
            $debug_recent = array_reverse( $debug_history );
            ?>
            <div class="notice notice-info" style="padding:12px 16px;">
                <p style="margin:0 0 8px;">
                    <strong>🔧 口コミ投稿フロー診断ログ（最新<?php echo count( $debug_recent ); ?>件）</strong>
                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&clear_review_debug=1' ), 'clear_review_debug' ); ?>"
                       class="button button-small" style="margin-left:10px;">ログをクリア</a>
                </p>
                <details style="margin-top:8px;">
                    <summary style="cursor:pointer; color:#2271b1;">詳細を開く</summary>
                    <div style="margin-top:10px; max-height:400px; overflow:auto; background:#fff; padding:10px; border:1px solid #c3c4c7; border-radius:4px;">
                        <?php foreach ( $debug_recent as $entry ) : ?>
                            <div style="border-bottom:1px solid #eee; padding:8px 0; font-family:monospace; font-size:12px; line-height:1.6;">
                                <strong>[<?php echo esc_html( $entry['time'] ?? '?' ); ?>]</strong>
                                POST=<?php echo $entry['has_post'] ? '✓' : '✗'; ?>
                                / nonce=<?php echo $entry['nonce_valid'] ? '✓' : '✗'; ?>
                                / name=<?php echo intval( $entry['name_len'] ?? 0 ); ?>chars
                                / email=<?php echo esc_html( $entry['email'] ?? '' ); ?>
                                / rating=<?php echo intval( $entry['rating'] ?? 0 ); ?>
                                / msg=<?php echo intval( $entry['msg_len'] ?? 0 ); ?>chars
                                <br>
                                <strong>validation:</strong> <?php echo esc_html( $entry['validation'] ?? 'n/a' ); ?>
                                / <strong>image:</strong> <?php echo esc_html( $entry['image_upload'] ?? '?' ); ?>
                                <?php if ( ! empty( $entry['file_name'] ) ) : ?>
                                    (file=<?php echo esc_html( $entry['file_name'] ); ?>,
                                    size=<?php echo intval( $entry['file_size'] ); ?>B,
                                    err=<?php echo esc_html( var_export( $entry['file_error'], true ) ); ?>)
                                <?php endif; ?>
                                <br>
                                <strong>save:</strong>
                                update_option=<?php echo var_export( $entry['update_option'] ?? null, true ); ?>
                                / before=<?php echo var_export( $entry['reviews_before'] ?? null, true ); ?>件
                                → after=<?php echo var_export( $entry['reviews_after'] ?? null, true ); ?>件
                                <?php if ( isset( $entry['db_direct_count'] ) ) : ?>
                                    <br>
                                    <strong>DB DIRECT:</strong> <?php echo esc_html( var_export( $entry['db_direct_count'], true ) ); ?>件
                                    (raw <?php echo esc_html( var_export( $entry['db_direct_bytes'] ?? 0, true ) ); ?>B)
                                <?php endif; ?>
                                <?php if ( isset( $entry['wpdb_existing_id'] ) || isset( $entry['wpdb_rows_affected'] ) ) : ?>
                                    <br>
                                    <strong>wpdb fallback:</strong>
                                    existing_id=<?php echo esc_html( var_export( $entry['wpdb_existing_id'] ?? null, true ) ); ?>
                                    / rows_affected=<?php echo esc_html( var_export( $entry['wpdb_rows_affected'] ?? null, true ) ); ?>
                                    / last_error=<?php echo esc_html( $entry['wpdb_last_error'] ?? 'none' ); ?>
                                <?php endif; ?>
                                <br>
                                draft=<?php echo esc_html( var_export( $entry['draft_post_id'] ?? null, true ) ); ?>
                                / redirect=<?php echo $entry['redirect'] ? '✓' : '✗'; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </details>
            </div>
        <?php endif; ?>

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
                        <th style="width: 60px;">公開</th>
                        <th style="width: 80px;">画像</th>
                        <th style="width: 120px;">投稿日時</th>
                        <th style="width: 100px;">お名前</th>
                        <th style="width: 180px;">メールアドレス</th>
                        <th style="width: 80px;">評価</th>
                        <th>メッセージ</th>
                        <th style="width: 240px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $reviews_display as $review ): ?>
                        <?php
                        $is_unread = empty( $review['read'] );
                        $is_approved = ( isset( $review['status'] ) && $review['status'] === 'approved' );
                        $is_editing = ( $editing_id > 0 && (int) $review['id'] === $editing_id );
                        ?>
                        <?php if ( $is_editing ): ?>
                        <tr class="psa-edit-row">
                            <td colspan="9">
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=psa-lp-reviews' ) ); ?>">
                                    <?php wp_nonce_field( 'save_review_' . $review['id'] ); ?>
                                    <input type="hidden" name="review_id" value="<?php echo esc_attr( $review['id'] ); ?>">
                                    <p><strong>投稿日時:</strong> <?php echo esc_html( $review['date'] ); ?>　|　<strong>評価:</strong> <?php echo str_repeat( '★', $review['rating'] ) . str_repeat( '☆', 5 - $review['rating'] ); ?></p>
                                    <p>
                                        <label><strong>お名前</strong></label><br>
                                        <input type="text" name="review_name" value="<?php echo esc_attr( $review['name'] ); ?>" required>
                                    </p>
                                    <p>
                                        <label><strong>メッセージ</strong></label><br>
                                        <textarea name="review_message" required><?php echo esc_textarea( $review['message'] ); ?></textarea>
                                    </p>
                                    <p>
                                        <button type="submit" name="save_review" class="button button-primary">保存</button>
                                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=psa-lp-reviews' ) ); ?>" class="button">キャンセル</a>
                                    </p>
                                </form>
                            </td>
                        </tr>
                        <?php else: ?>
                        <tr class="<?php echo $is_unread ? 'psa-review-unread' : ''; ?>">
                            <td>
                                <?php if ( $is_unread ): ?>
                                    <span class="psa-badge-new">NEW</span>
                                <?php else: ?>
                                    <span style="color: #999;">✓</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ( $is_approved ): ?>
                                    <span class="psa-badge-approved">公開中</span>
                                <?php else: ?>
                                    <span class="psa-badge-pending">非公開</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $att_id    = isset( $review['attachment_id'] ) ? (int) $review['attachment_id'] : 0;
                                $show_img  = ! empty( $review['show_image'] );
                                if ( $att_id ) :
                                    $thumb_url = wp_get_attachment_image_url( $att_id, 'thumbnail' );
                                    $full_url  = wp_get_attachment_url( $att_id );
                                    ?>
                                    <a href="<?php echo esc_url( $full_url ); ?>" target="_blank" rel="noopener" class="psa-review-thumb-link" title="クリックで原寸表示">
                                        <img src="<?php echo esc_url( $thumb_url ); ?>" alt="" class="psa-review-thumb">
                                    </a>
                                    <div style="margin-top:4px;">
                                        <?php if ( $show_img ): ?>
                                            <span class="psa-badge-image-on" title="LPの口コミエリアに画像も表示されます">LP表示中</span>
                                        <?php else: ?>
                                            <span class="psa-badge-image-off" title="承認しても画像は出ません">LP非表示</span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span style="color:#999;">—</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo esc_html( $review['date'] ); ?></td>
                            <td><?php echo esc_html( $review['name'] ); ?></td>
                            <td><?php echo esc_html( isset( $review['email'] ) ? $review['email'] : '' ); ?></td>
                            <td><?php echo str_repeat( '★', $review['rating'] ) . str_repeat( '☆', 5 - $review['rating'] ); ?></td>
                            <td><?php echo nl2br( esc_html( $review['message'] ) ); ?></td>
                            <td>
                                <a href="<?php echo esc_url( admin_url( 'admin.php?page=psa-lp-reviews&edit_review=' . $review['id'] ) ); ?>"
                                   class="button button-small">編集</a>
                                <?php if ( $is_approved ): ?>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&unapprove_review=' . $review['id'] ), 'unapprove_review_' . $review['id'] ); ?>"
                                       class="button button-small" style="color: #996800;">非公開にする</a>
                                <?php else: ?>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&approve_review=' . $review['id'] ), 'approve_review_' . $review['id'] ); ?>"
                                       class="button button-small" style="background: #00a32a; color: #fff; border-color: #00a32a;">承認（公開）</a>
                                <?php endif; ?>
                                <?php if ( $att_id ): ?>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&toggle_image=' . $review['id'] ), 'toggle_image_' . $review['id'] ); ?>"
                                       class="button button-small" title="LP上で画像を表示するか切り替え">
                                        <?php echo $show_img ? '画像を隠す' : '画像を表示'; ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ( $is_unread ): ?>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&mark_read=' . $review['id'] ), 'mark_read_' . $review['id'] ); ?>"
                                       class="button button-small button-primary">確認済み</a>
                                <?php endif; ?>
                                <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-reviews&delete_review=' . $review['id'] ), 'delete_review_' . $review['id'] ); ?>"
                                   onclick="return confirm('この口コミを削除しますか？');"
                                   class="button button-small">削除</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}
/**
 * PSA LP お問い合わせ管理メニューを追加
 */
function psa_lp_contacts_admin_menu() {
    $unread_count = psa_lp_get_unread_contacts_count();
    $menu_title = 'PSA LP';
    if ( $unread_count > 0 ) {
        $menu_title .= ' <span class="awaiting-mod">' . $unread_count . '</span>';
    }

    // Contact Form 7の「お問い合わせ」メニューのサブメニューとして追加
    add_submenu_page(
        'wpcf7',                    // 親メニューのスラッグ（Contact Form 7）
        'PSA LP お問い合わせ',       // ページタイトル
        $menu_title,                // メニュータイトル
        'manage_options',           // 権限
        'psa-lp-contacts',          // スラッグ
        'psa_lp_contacts_page'      // コールバック関数
    );
}
add_action( 'admin_menu', 'psa_lp_contacts_admin_menu' );

/**
 * 未読のお問い合わせ数を取得
 */
function psa_lp_get_unread_contacts_count() {
    $contacts = get_option( 'psa_lp_contacts', array() );
    $count = 0;
    foreach ( $contacts as $contact ) {
        if ( empty( $contact['read'] ) ) {
            $count++;
        }
    }
    return $count;
}

/**
 * PSA LP お問い合わせ管理ページ
 */
function psa_lp_contacts_page() {
    $contacts = get_option( 'psa_lp_contacts', array() );

    // 確認済みにする
    if ( isset( $_GET['mark_read'] ) && isset( $_GET['_wpnonce'] ) ) {
        $contact_id = sanitize_text_field( $_GET['mark_read'] );
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'mark_read_contact_' . $contact_id ) ) {
            foreach ( $contacts as &$contact ) {
                if ( $contact['id'] === $contact_id ) {
                    $contact['read'] = true;
                    break;
                }
            }
            update_option( 'psa_lp_contacts', $contacts );
            wp_redirect( admin_url( 'admin.php?page=psa-lp-contacts&marked=1' ) );
            exit;
        }
    }

    // 全て確認済みにする
    if ( isset( $_GET['mark_all_read'] ) && isset( $_GET['_wpnonce'] ) ) {
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'mark_all_read_contacts' ) ) {
            foreach ( $contacts as &$contact ) {
                $contact['read'] = true;
            }
            update_option( 'psa_lp_contacts', $contacts );
            wp_redirect( admin_url( 'admin.php?page=psa-lp-contacts&all_marked=1' ) );
            exit;
        }
    }

    // 削除
    if ( isset( $_GET['delete_contact'] ) && isset( $_GET['_wpnonce'] ) ) {
        $contact_id = sanitize_text_field( $_GET['delete_contact'] );
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'delete_contact_' . $contact_id ) ) {
            $contacts = array_filter( $contacts, function( $c ) use ( $contact_id ) {
                return $c['id'] !== $contact_id;
            } );
            update_option( 'psa_lp_contacts', array_values( $contacts ) );
            wp_redirect( admin_url( 'admin.php?page=psa-lp-contacts&deleted=1' ) );
            exit;
        }
    }

    // 新しい順に並べ替え
    $contacts_display = array_reverse( $contacts );
    $unread_count = psa_lp_get_unread_contacts_count();

    ?>
    <style>
        .psa-contact-unread { background-color: #fff8e1 !important; }
        .psa-badge-new {
            background: #d63638;
            color: #fff;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: bold;
        }
        .psa-contact-message {
            max-width: 400px;
            white-space: pre-wrap;
            word-break: break-word;
        }
    </style>
    <div class="wrap">
        <h1>PSA LP お問い合わせ管理</h1>

        <?php if ( isset( $_GET['marked'] ) ): ?>
            <div class="notice notice-success is-dismissible"><p>確認済みにしました。</p></div>
        <?php endif; ?>
        <?php if ( isset( $_GET['all_marked'] ) ): ?>
            <div class="notice notice-success is-dismissible"><p>全て確認済みにしました。</p></div>
        <?php endif; ?>
        <?php if ( isset( $_GET['deleted'] ) ): ?>
            <div class="notice notice-success is-dismissible"><p>削除しました。</p></div>
        <?php endif; ?>

        <p>
            お問い合わせ件数: <strong><?php echo count( $contacts ); ?></strong> 件
            <?php if ( $unread_count > 0 ): ?>
                （未読: <strong style="color: #d63638;"><?php echo $unread_count; ?></strong> 件）
                <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-contacts&mark_all_read=1' ), 'mark_all_read_contacts' ); ?>"
                   class="button button-secondary" style="margin-left: 10px;">全て確認済みにする</a>
            <?php endif; ?>
        </p>

        <?php if ( empty( $contacts ) ): ?>
            <p>まだお問い合わせはありません。</p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th style="width: 40px;">状態</th>
                        <th style="width: 140px;">受信日時</th>
                        <th style="width: 120px;">お名前</th>
                        <th style="width: 180px;">メールアドレス</th>
                        <th>お問い合わせ内容</th>
                        <th style="width: 150px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $contacts_display as $contact ): ?>
                        <?php $is_unread = empty( $contact['read'] ); ?>
                        <tr class="<?php echo $is_unread ? 'psa-contact-unread' : ''; ?>">
                            <td>
                                <?php if ( $is_unread ): ?>
                                    <span class="psa-badge-new">NEW</span>
                                <?php else: ?>
                                    <span style="color: #999;">✓</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo esc_html( $contact['date'] ); ?></td>
                            <td><?php echo esc_html( $contact['name'] ); ?></td>
                            <td><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></td>
                            <td class="psa-contact-message"><?php echo nl2br( esc_html( $contact['message'] ) ); ?></td>
                            <td>
                                <?php if ( $is_unread ): ?>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-contacts&mark_read=' . $contact['id'] ), 'mark_read_contact_' . $contact['id'] ); ?>"
                                       class="button button-small button-primary">確認済み</a>
                                <?php endif; ?>
                                <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>?subject=Re: PSA代行お問い合わせ"
                                   class="button button-small">返信</a>
                                <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=psa-lp-contacts&delete_contact=' . $contact['id'] ), 'delete_contact_' . $contact['id'] ); ?>"
                                   onclick="return confirm('このお問い合わせを削除しますか？');"
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

/**
 * 利用者口コミ用の共通アイキャッチ画像のメディアID
 * 変更が必要な場合はこの定数 or 'kanucard_review_eyecatch_id' option を更新する
 */
if ( ! defined( 'KANUCARD_REVIEW_EYECATCH_ID' ) ) {
    define( 'KANUCARD_REVIEW_EYECATCH_ID', 1165 );
}

/**
 * 「利用者口コミ」カテゴリの term_id を取得（なければ作成）
 */
function kanucard_get_review_category_id() {
    static $cached = null;
    if ( $cached !== null ) { return $cached; }
    $cat_name = '利用者口コミ';
    $cat = get_term_by( 'name', $cat_name, 'category' );
    if ( ! $cat ) {
        $result = wp_insert_term( $cat_name, 'category' );
        $cached = is_wp_error( $result ) ? 0 : (int) $result['term_id'];
    } else {
        $cached = (int) $cat->term_id;
    }
    return $cached;
}

/**
 * 投稿から正規化された口コミ配列を作る。
 * 新規投稿は post_meta が完備されているのでそれを返す。
 * 過去投稿（メタなし）は post_title / post_content から復元する。
 */
function kanucard_review_from_post( $post ) {
    $pid = $post->ID;

    $name = get_post_meta( $pid, '_psa_review_name', true );
    $rating = (int) get_post_meta( $pid, '_psa_review_rating', true );
    $message = get_post_meta( $pid, '_psa_review_message', true );

    // 過去の post には meta が入っていない。post_content から fallback で抽出
    if ( $name === '' && $message === '' ) {
        $content = $post->post_content;

        if ( preg_match( '/<strong>投稿者：<\/strong>(.+?)<\/p>/u', $content, $m ) ) {
            $name = trim( wp_strip_all_tags( $m[1] ) );
        }
        if ( ! $rating && preg_match( '/(\d+)\s*\/\s*5/u', $content, $m ) ) {
            $rating = (int) $m[1];
        }
        if ( ! $rating && preg_match_all( '/★/u', $content, $m ) ) {
            $rating = count( $m[0] );
        }
        if ( preg_match( '/<blockquote>(.+?)<\/blockquote>/us', $content, $m ) ) {
            $raw = $m[1];
            $raw = str_ireplace( array( '<br />', '<br/>', '<br>' ), "\n", $raw );
            $message = trim( wp_strip_all_tags( $raw ) );
        }
    }

    $attachment_id = (int) get_post_meta( $pid, '_psa_review_attachment_id', true );
    if ( ! $attachment_id ) {
        // fallback: アイキャッチが共通画像でなければ投稿者添付として扱う
        $thumb_id = (int) get_post_thumbnail_id( $pid );
        $eyecatch = (int) get_option( 'kanucard_review_eyecatch_id', defined( 'KANUCARD_REVIEW_EYECATCH_ID' ) ? KANUCARD_REVIEW_EYECATCH_ID : 0 );
        if ( $thumb_id && $thumb_id !== $eyecatch ) {
            $attachment_id = $thumb_id;
        }
    }

    // 名前の正規化: 末尾の敬称（様/さん/サン/殿/さま/サマ/くん/ちゃん）を全てストリップ。
    // テンプレート側で「 様」を付与するため、二重敬称（"山田 様 様"）を防ぐ。
    $name = trim( $name );
    $name = preg_replace( '/(?:[ \x{3000}　]*(?:様|さま|サマ|さん|サン|殿|くん|ちゃん))+$/u', '', $name );
    $name = trim( $name );

    return array(
        'id'            => (string) $pid,
        'name'          => $name, // 空の場合は空文字。テンプレート側で表示を分岐
        'email'         => (string) get_post_meta( $pid, '_psa_review_email', true ),
        'rating'        => max( 0, min( 5, $rating ) ),
        'message'       => $message,
        'date'          => $post->post_date,
        'status'        => ( $post->post_status === 'publish' ) ? 'approved' : 'pending',
        'attachment_id' => $attachment_id,
        'show_image'    => metadata_exists( 'post', $pid, '_psa_review_show_image' )
                            ? (bool) get_post_meta( $pid, '_psa_review_show_image', true )
                            : true,
        'read'          => (bool) get_post_meta( $pid, '_psa_review_read', true ),
    );
}

/**
 * 「利用者口コミ」カテゴリの投稿を全件取得し、口コミ配列に変換して返す
 *
 * @param array $args wp_query 用追加引数（'post_status' など）
 * @return array
 */
function kanucard_get_reviews( $args = array() ) {
    $cat_id = kanucard_get_review_category_id();
    if ( ! $cat_id ) { return array(); }

    $defaults = array(
        'category'       => $cat_id,
        'post_type'      => 'post',
        'post_status'    => array( 'draft', 'pending', 'publish' ),
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'suppress_filters' => true,
    );
    $query_args = array_merge( $defaults, $args );

    $posts = get_posts( $query_args );
    return array_map( 'kanucard_review_from_post', $posts );
}

/**
 * 口コミ投稿時に「利用者口コミ」カテゴリの下書きを自動作成
 *
 * @param string $name           投稿者名
 * @param int    $rating         星評価
 * @param string $message        本文
 * @param int    $attachment_id  ユーザー添付画像のメディアID（0 = なし）
 * @param string $email          投稿者メールアドレス
 */
function kanucard_create_review_draft( $name, $rating, $message, $attachment_id = 0, $email = '' ) {
    // 「利用者口コミ」カテゴリを取得（なければ作成）
    $cat_id = kanucard_get_review_category_id();
    if ( ! $cat_id ) { $cat_id = 1; }

    // タイトル：（YYYY年M月D日）の口コミ
    $date_str = current_time( 'Y年n月j日' );
    $title = '（' . $date_str . '）の口コミ';

    // 本文：口コミ内容を整形
    $stars = str_repeat( '★', $rating ) . str_repeat( '☆', 5 - $rating );
    $content  = '<p><strong>投稿者：</strong>' . esc_html( $name ) . '</p>' . "\n";
    $content .= '<p><strong>評価：</strong>' . $stars . '（' . $rating . '/5）</p>' . "\n";
    $content .= '<p><strong>内容：</strong></p>' . "\n";
    $content .= '<blockquote>' . nl2br( esc_html( $message ) ) . '</blockquote>';

    // 添付画像が指定されていれば本文末尾に挿入（メディアライブラリに登録済み）
    if ( $attachment_id ) {
        $img_html = wp_get_attachment_image( $attachment_id, 'large' );
        if ( $img_html ) {
            $content .= "\n" . '<p><strong>添付画像：</strong></p>' . "\n" . $img_html;
        }
    }

    $post_data = array(
        'post_title'    => $title,
        'post_content'  => $content,
        'post_status'   => 'draft',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_category' => array( $cat_id ),
    );

    $post_id = wp_insert_post( $post_data );

    // アイキャッチを設定：投稿者添付画像があればそれを優先、なければ共通画像
    if ( $post_id && ! is_wp_error( $post_id ) ) {
        if ( $attachment_id ) {
            set_post_thumbnail( $post_id, $attachment_id );
            // 添付画像をこの投稿に紐付け（メディアライブラリ上の親子関係）
            wp_update_post( array( 'ID' => $attachment_id, 'post_parent' => $post_id ) );
        } else {
            $eyecatch_id = (int) get_option( 'kanucard_review_eyecatch_id', KANUCARD_REVIEW_EYECATCH_ID );
            if ( $eyecatch_id > 0 ) {
                set_post_thumbnail( $post_id, $eyecatch_id );
            }
        }

        // すべてのメタを保存（admin / LP 表示はこのメタから直接読む）
        update_post_meta( $post_id, '_psa_review_name',          (string) $name );
        update_post_meta( $post_id, '_psa_review_email',         (string) $email );
        update_post_meta( $post_id, '_psa_review_rating',        (int) $rating );
        update_post_meta( $post_id, '_psa_review_message',       (string) $message );
        update_post_meta( $post_id, '_psa_review_attachment_id', (int) $attachment_id );
        update_post_meta( $post_id, '_psa_review_show_image',    1 );
        update_post_meta( $post_id, '_psa_review_read',          0 );
    }

    return $post_id;
}

/**
 * 業務委託募集ページのアセット読み込み
 */
function jin_child_kanucard_recruitment_assets() {
    if ( is_page_template( 'template-recruitment.php' ) ) {
        // 業務委託募集ページ専用CSS
        wp_enqueue_style(
            'kanucard-recruitment-style',
            get_stylesheet_directory_uri() . '/assets/css/recruitment.css',
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

        // AOS JavaScript
        wp_enqueue_script(
            'aos',
            'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',
            array(),
            '2.3.4',
            true
        );

        // AOS初期化スクリプト
        wp_add_inline_script( 'aos', 'AOS.init({ duration: 800, once: true });' );
    }
}
add_action( 'wp_enqueue_scripts', 'jin_child_kanucard_recruitment_assets' );


/**
 * 業務委託募集ページのbody class追加
 */
function jin_child_kanucard_recruitment_body_class( $classes ) {
    if ( is_page_template( 'template-recruitment.php' ) ) {
        $classes[] = 'kanucard-recruitment-page';
    }
    if ( is_page_template( 'template-flow.php' ) ) {
        $classes[] = 'flow-page';
    }
    return $classes;
}
add_filter( 'body_class', 'jin_child_kanucard_recruitment_body_class' );

/**
 * 全メニューの先頭に「ホーム」リンクを追加
 */
function kanucard_add_home_to_menu( $items, $args ) {
    $home_url = home_url( '/' );
    $home_item = '<li class="menu-item menu-item-home"><a href="' . esc_url( $home_url ) . '">ホーム</a></li>';
    $items = $home_item . $items;
    return $items;
}
add_filter( 'wp_nav_menu_items', 'kanucard_add_home_to_menu', 10, 2 );

/**
 * 業務委託応募管理メニュー
 */
function recruitment_applications_admin_menu() {
    $applications = get_option( 'recruitment_applications', array() );
    $unread_count = 0;
    foreach ( $applications as $app ) {
        if ( empty( $app['read'] ) ) {
            $unread_count++;
        }
    }

    $menu_title = '業務委託応募';
    if ( $unread_count > 0 ) {
        $menu_title .= sprintf( ' <span class="awaiting-mod">%d</span>', $unread_count );
    }

    add_menu_page(
        '業務委託応募管理',
        $menu_title,
        'manage_options',
        'recruitment-applications',
        'recruitment_applications_admin_page',
        'dashicons-businessman',
        31
    );
}
add_action( 'admin_menu', 'recruitment_applications_admin_menu' );

/**
 * 業務委託応募管理ページ
 */
function recruitment_applications_admin_page() {
    $applications = get_option( 'recruitment_applications', array() );

    // 削除処理
    if ( isset( $_GET['delete_app'] ) && isset( $_GET['_wpnonce'] ) ) {
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'delete_app_' . $_GET['delete_app'] ) ) {
            $applications = array_filter( $applications, function( $a ) {
                return $a['id'] !== $_GET['delete_app'];
            });
            update_option( 'recruitment_applications', array_values( $applications ) );
            $applications = array_values( $applications );
            echo '<div class="notice notice-success"><p>応募を削除しました。</p></div>';
        }
    }

    // 確認済み処理
    if ( isset( $_GET['mark_read'] ) && isset( $_GET['_wpnonce'] ) ) {
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'mark_read_' . $_GET['mark_read'] ) ) {
            foreach ( $applications as &$a ) {
                if ( $a['id'] === $_GET['mark_read'] ) {
                    $a['read'] = true;
                    break;
                }
            }
            unset( $a );
            update_option( 'recruitment_applications', $applications );
            echo '<div class="notice notice-success"><p>確認済みにしました。</p></div>';
        }
    }

    // 全て確認済み処理
    if ( isset( $_GET['mark_all_read'] ) && isset( $_GET['_wpnonce'] ) ) {
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'mark_all_read' ) ) {
            foreach ( $applications as &$a ) {
                $a['read'] = true;
            }
            unset( $a );
            update_option( 'recruitment_applications', $applications );
            echo '<div class="notice notice-success"><p>全て確認済みにしました。</p></div>';
        }
    }

    // 未確認件数
    $unread_count = 0;
    foreach ( $applications as $app ) {
        if ( empty( $app['read'] ) ) {
            $unread_count++;
        }
    }

    $apps_display = array_reverse( $applications );
    ?>
    <style>
        .recruitment-unread { background-color: #fff8e5 !important; }
        .recruitment-unread td { border-left: 3px solid #f0c14b; }
        .recruitment-badge-new { background: #d63638; color: #fff; padding: 2px 6px; border-radius: 3px; font-size: 11px; margin-left: 5px; }
        .recruitment-message { max-width: 300px; white-space: pre-wrap; word-break: break-word; }
    </style>
    <div class="wrap">
        <h1>業務委託応募管理</h1>
        <p>
            応募一覧です。（<?php echo count( $applications ); ?>件）
            <?php if ( $unread_count > 0 ): ?>
                <span class="recruitment-badge-new">未確認: <?php echo $unread_count; ?>件</span>
                <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=recruitment-applications&mark_all_read=1' ), 'mark_all_read' ); ?>"
                   class="button button-secondary" style="margin-left: 10px;">全て確認済みにする</a>
            <?php endif; ?>
        </p>

        <?php if ( empty( $applications ) ): ?>
            <p>まだ応募はありません。</p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th style="width: 40px;">状態</th>
                        <th style="width: 140px;">応募日時</th>
                        <th style="width: 100px;">お名前</th>
                        <th style="width: 180px;">メールアドレス</th>
                        <th style="width: 120px;">電話番号</th>
                        <th>志望動機</th>
                        <th style="width: 150px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $apps_display as $app ): ?>
                        <?php $is_unread = empty( $app['read'] ); ?>
                        <tr class="<?php echo $is_unread ? 'recruitment-unread' : ''; ?>">
                            <td>
                                <?php if ( $is_unread ): ?>
                                    <span class="recruitment-badge-new">NEW</span>
                                <?php else: ?>
                                    <span style="color: #999;">✓</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo esc_html( $app['date'] ); ?></td>
                            <td><?php echo esc_html( $app['name'] ); ?></td>
                            <td><a href="mailto:<?php echo esc_attr( $app['email'] ); ?>"><?php echo esc_html( $app['email'] ); ?></a></td>
                            <td><?php echo esc_html( $app['phone'] ); ?></td>
                            <td class="recruitment-message"><?php echo nl2br( esc_html( $app['message'] ) ); ?></td>
                            <td>
                                <?php if ( $is_unread ): ?>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=recruitment-applications&mark_read=' . $app['id'] ), 'mark_read_' . $app['id'] ); ?>"
                                       class="button button-small button-primary">確認済み</a>
                                <?php endif; ?>
                                <a href="mailto:<?php echo esc_attr( $app['email'] ); ?>?subject=業務委託応募について"
                                   class="button button-small">返信</a>
                                <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=recruitment-applications&delete_app=' . $app['id'] ), 'delete_app_' . $app['id'] ); ?>"
                                   onclick="return confirm('この応募を削除しますか？');"
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
