<?php
/**
 * Kanucard LP Theme functions and definitions
 *
 * @package Kanucard_LP
 */

// テーマのバージョン
define( 'KANUCARD_LP_VERSION', '1.0.0' );

/**
 * テーマのセットアップ
 */
function kanucard_lp_setup() {
    // 翻訳サポート
    load_theme_textdomain( 'kanucard-lp', get_template_directory() . '/languages' );

    // タイトルタグサポート
    add_theme_support( 'title-tag' );

    // 投稿サムネイルサポート
    add_theme_support( 'post-thumbnails' );

    // HTML5マークアップサポート
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // カスタムロゴサポート
    add_theme_support( 'custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // ナビゲーションメニュー登録
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'kanucard-lp' ),
        'footer'  => esc_html__( 'Footer Menu', 'kanucard-lp' ),
    ) );

    // Gutenbergのワイド幅サポート
    add_theme_support( 'align-wide' );

    // レスポンシブ埋め込みサポート
    add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'kanucard_lp_setup' );

/**
 * スタイルシートとスクリプトの登録
 */
function kanucard_lp_scripts() {
    // メインスタイルシート
    wp_enqueue_style(
        'kanucard-lp-style',
        get_stylesheet_uri(),
        array(),
        KANUCARD_LP_VERSION
    );

    // カスタムスタイルシート
    wp_enqueue_style(
        'kanucard-lp-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        KANUCARD_LP_VERSION
    );

    // アニメーションライブラリ（AOS）
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

    // メインJavaScript
    wp_enqueue_script(
        'kanucard-lp-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'),
        KANUCARD_LP_VERSION,
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

    // スムーススクロール
    wp_enqueue_script(
        'smooth-scroll',
        'https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js',
        array(),
        '15.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'kanucard_lp_scripts' );

/**
 * カスタマイザーの追加
 */
function kanucard_lp_customize_register( $wp_customize ) {
    // LP設定セクション
    $wp_customize->add_section( 'kanucard_lp_settings', array(
        'title'    => __( 'Landing Page Settings', 'kanucard-lp' ),
        'priority' => 30,
    ) );

    // ヒーローセクションのタイトル
    $wp_customize->add_setting( 'hero_title', array(
        'default'           => 'Welcome to Kanucard',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'hero_title', array(
        'label'    => __( 'Hero Title', 'kanucard-lp' ),
        'section'  => 'kanucard_lp_settings',
        'type'     => 'text',
    ) );

    // ヒーローセクションのサブタイトル
    $wp_customize->add_setting( 'hero_subtitle', array(
        'default'           => 'Your success starts here',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'hero_subtitle', array(
        'label'    => __( 'Hero Subtitle', 'kanucard-lp' ),
        'section'  => 'kanucard_lp_settings',
        'type'     => 'text',
    ) );

    // CTA ボタンテキスト
    $wp_customize->add_setting( 'cta_button_text', array(
        'default'           => 'Get Started',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'cta_button_text', array(
        'label'    => __( 'CTA Button Text', 'kanucard-lp' ),
        'section'  => 'kanucard_lp_settings',
        'type'     => 'text',
    ) );

    // CTA ボタンURL
    $wp_customize->add_setting( 'cta_button_url', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'cta_button_url', array(
        'label'    => __( 'CTA Button URL', 'kanucard-lp' ),
        'section'  => 'kanucard_lp_settings',
        'type'     => 'url',
    ) );
}
add_action( 'customize_register', 'kanucard_lp_customize_register' );

/**
 * カスタムランディングページテンプレートの登録
 */
function kanucard_lp_add_page_template( $templates ) {
    $templates['template-landing.php'] = 'Landing Page';
    return $templates;
}
add_filter( 'theme_page_templates', 'kanucard_lp_add_page_template' );

/**
 * コンタクトフォーム処理（Ajax）
 */
function kanucard_lp_process_contact_form() {
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
add_action( 'wp_ajax_kanucard_contact', 'kanucard_lp_process_contact_form' );
add_action( 'wp_ajax_nopriv_kanucard_contact', 'kanucard_lp_process_contact_form' );

/**
 * カスタムウィジェットエリアの登録
 */
function kanucard_lp_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widgets', 'kanucard-lp' ),
        'id'            => 'footer-widgets',
        'description'   => esc_html__( 'Add widgets here for footer area.', 'kanucard-lp' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'kanucard_lp_widgets_init' );