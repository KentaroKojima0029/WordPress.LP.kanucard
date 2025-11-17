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