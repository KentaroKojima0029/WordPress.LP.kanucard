<?php
/**
 * Template Name: PSA代行 Landing Page
 * Template Post Type: page
 *
 * PSA鑑定代行サービス専用ランディングページテンプレート
 *
 * @package JIN_Child_Kanucard
 */

// アセットのベースURL
$theme_url = get_stylesheet_directory_uri();

// お問い合わせフォーム処理
$psa_contact_error = '';
$psa_contact_success = false;
if (isset($_POST['submit_contact']) && isset($_POST['psa_contact_nonce']) && wp_verify_nonce($_POST['psa_contact_nonce'], 'psa_contact_form')) {
    $contact_name = sanitize_text_field($_POST['contact_name']);
    $contact_email = sanitize_email($_POST['contact_email']);
    $contact_message = sanitize_textarea_field($_POST['contact_message']);

    if (empty($contact_name) || empty($contact_email) || empty($contact_message)) {
        $psa_contact_error = 'すべての項目を入力してください。';
    } elseif (!is_email($contact_email)) {
        $psa_contact_error = '正しいメールアドレスを入力してください。';
    } else {
        // WordPressに保存
        $contacts = get_option('psa_lp_contacts', array());
        $new_contact = array(
            'id' => uniqid(),
            'name' => $contact_name,
            'email' => $contact_email,
            'message' => $contact_message,
            'date' => current_time('Y-m-d H:i:s'),
            'read' => false
        );
        $contacts[] = $new_contact;
        update_option('psa_lp_contacts', $contacts);

        // メール送信
        $to = 'contact@kanucard.com';
        $subject = '【PSA代行LP】新しいお問い合わせ';
        $email_message = "PSA代行LPから新しいお問い合わせがありました。\n\n";
        $email_message .= "━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $email_message .= "お名前: " . $contact_name . "\n";
        $email_message .= "メールアドレス: " . $contact_email . "\n";
        $email_message .= "━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $email_message .= "【お問い合わせ内容】\n" . $contact_message . "\n\n";
        $email_message .= "━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $email_message .= "送信日時: " . current_time('Y-m-d H:i:s') . "\n";
        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $contact_name . ' <' . $contact_email . '>'
        );
        wp_mail($to, $subject, $email_message, $headers);

        $psa_contact_success = true;
    }
}

// 口コミフォーム処理（リダイレクトのためHTML出力前に実行）
$psa_review_error = '';
if (isset($_POST['submit_review']) && isset($_POST['psa_review_nonce']) && wp_verify_nonce($_POST['psa_review_nonce'], 'psa_review_form')) {
    $review_name = sanitize_text_field($_POST['review_name']);
    $review_email = sanitize_email($_POST['review_email']);
    $review_rating = intval($_POST['review_rating']);
    $review_message = sanitize_textarea_field($_POST['review_message']);

    if (empty($review_name) || empty($review_email) || empty($review_rating) || empty($review_message)) {
        $psa_review_error = 'すべての項目を入力してください。';
    } elseif (!is_email($review_email)) {
        $psa_review_error = '正しいメールアドレスを入力してください。';
    } elseif ($review_rating < 1 || $review_rating > 5) {
        $psa_review_error = '評価は1〜5の範囲で選択してください。';
    } else {
        // 口コミをデータベースに保存
        $reviews = get_option('psa_lp_reviews', array());
        $new_review = array(
            'id' => uniqid(),
            'name' => $review_name,
            'email' => $review_email,
            'rating' => $review_rating,
            'message' => $review_message,
            'date' => current_time('Y-m-d H:i:s'),
            'status' => 'pending'
        );
        $reviews[] = $new_review;
        update_option('psa_lp_reviews', $reviews);

        // 口コミを「利用者口コミ」カテゴリの下書き投稿として作成
        kanucard_create_review_draft( $review_name, $review_rating, $review_message );

        // メール送信を試みる
        $to = 'contact@kanucard.com';
        $subject = 'PSA代行LPに新しい口コミが投稿されました';
        $email_message = "PSA代行LPに新しい口コミが投稿されました。\n\n";
        $email_message .= "お名前: " . $review_name . "\n";
        $email_message .= "評価: " . str_repeat('★', $review_rating) . str_repeat('☆', 5 - $review_rating) . " (" . $review_rating . "/5)\n";
        $email_message .= "メッセージ:\n" . $review_message . "\n\n";
        $email_message .= "投稿日時: " . current_time('Y-m-d H:i:s') . "\n";
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        wp_mail($to, $subject, $email_message, $headers);

        // PRGパターン: リダイレクトして重複送信を防止
        $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');
        $redirect_url = add_query_arg('review_submitted', '1', $current_url) . '#review';
        wp_safe_redirect($redirect_url);
        exit;
    }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSA鑑定代行 | 実績7,000枚以上・返金保証 | カヌカード</title>
    <meta name="description" content="PSA鑑定代行なら実績7,000枚以上のカヌカード。70%保証プランで返金保証付き、無料検品サービスでPSA10を狙えるカードのみ厳選。初心者でも安心のメッセージサポート完備。">

    <!-- OGP -->
    <meta property="og:title" content="PSA鑑定代行 | 実績7,000枚以上・返金保証 | カヌカード">
    <meta property="og:description" content="7,000枚以上のPSA10実績。70%保証プランで安心の返金保証付き。">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo get_permalink(); ?>">
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php wp_head(); ?>

    <!-- Viewport - must be after wp_head to prevent override -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">

    <!-- PSA LP Styles - loaded after wp_head to override parent theme -->
    <link rel="stylesheet" href="<?php echo $theme_url; ?>/psa-lp/css/style.css?v=<?php echo time(); ?>">

    <!-- Force responsive styles - Critical mobile overrides -->
    <style>
        /* Reset viewport behavior */
        @viewport { width: device-width; }
        @-ms-viewport { width: device-width; }

        html {
            -webkit-text-size-adjust: 100% !important;
            -ms-text-size-adjust: 100% !important;
            text-size-adjust: 100% !important;
        }

        html, body {
            max-width: 100% !important;
            overflow-x: hidden !important;
            width: 100% !important;
        }

        /* Mobile styles - 768px and below */
        @media screen and (max-width: 768px) {
            /* Navigation */
            .sp-only { display: inline !important; }
            .main-nav, .header-cta { display: none !important; }
            .mobile-toggle { display: block !important; }

            /* Container */
            .container {
                padding: 0 16px !important;
                max-width: 100% !important;
            }

            /* Hero section */
            .hero {
                min-height: auto !important;
                padding: 100px 16px 60px !important;
            }

            .hero-title {
                font-size: 1.75rem !important;
                line-height: 1.4 !important;
            }

            .hero-title small {
                font-size: 0.9rem !important;
                display: block !important;
                margin-top: 0.5rem !important;
            }

            .hero-subtitle {
                font-size: 0.95rem !important;
            }

            /* Stats - vertical layout */
            .hero-stats {
                flex-direction: column !important;
                gap: 0.75rem !important;
            }

            .stat-item {
                flex-direction: row !important;
                width: 100% !important;
                min-width: auto !important;
                padding: 0.875rem 1.25rem !important;
                justify-content: flex-start !important;
                gap: 1rem !important;
            }

            /* Buttons - full width */
            .hero-cta {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 1rem !important;
            }

            .hero-cta .btn,
            .btn-large,
            .btn-xlarge {
                width: 100% !important;
                max-width: none !important;
            }

            /* Section titles */
            .section-title {
                font-size: 1.5rem !important;
            }

            /* Grids - single column */
            .problems-grid,
            .solutions-grid,
            .plans-grid,
            .testimonials-grid,
            .flow-steps {
                display: flex !important;
                flex-direction: column !important;
                gap: 1rem !important;
            }

            .results-stats {
                grid-template-columns: 1fr 1fr !important;
            }

            /* Cards */
            .solution-card,
            .plan-card,
            .flow-step {
                width: 100% !important;
                max-width: none !important;
                min-width: auto !important;
            }

            /* スライダー内のカードはflex幅を維持 */
            .testimonial-slide {
                width: auto !important;
                max-width: none !important;
            }

            /* Plan badge - attached to card top */
            .plan-card {
                overflow: visible !important;
            }

            .plan-card.has-badge {
                margin-top: 2.5rem !important;
                border: 4px solid #D4AF37 !important;
                box-shadow: 0 10px 40px rgba(212, 175, 55, 0.2) !important;
            }

            .plan-badge {
                top: 0 !important;
                transform: translateX(-50%) translateY(-100%) !important;
                border-radius: 12px 12px 0 0 !important;
                white-space: nowrap !important;
                padding: 0.5rem 2rem !important;
                background: linear-gradient(135deg, #D4AF37 0%, #F4D03F 50%, #D4AF37 100%) !important;
            }

            /* Flow arrows - hide */
            .flow-arrow {
                display: none !important;
            }

            /* Trust badges - vertical */
            .trust-badges {
                flex-direction: column !important;
                gap: 0.75rem !important;
            }

            .trust-badge {
                width: 100% !important;
            }

            /* CTA buttons */
            .cta-buttons {
                flex-direction: column !important;
                align-items: stretch !important;
            }

            .cta-buttons .btn {
                width: 100% !important;
            }

            /* Footer */
            .footer-main {
                grid-template-columns: 1fr !important;
                text-align: center !important;
            }
        }

        /* Small phones - 480px and below */
        @media screen and (max-width: 480px) {
            .container {
                padding: 0 12px !important;
            }

            .hero {
                padding: 90px 12px 50px !important;
            }

            .hero-title {
                font-size: 1.5rem !important;
            }

            .results-stats {
                grid-template-columns: 1fr !important;
            }
        }

        /* iPhone SE - 375px and below */
        @media screen and (max-width: 375px) {
            .hero-title {
                font-size: 1.35rem !important;
            }

            .hero-title small {
                font-size: 0.8rem !important;
            }

            .section-title {
                font-size: 1.25rem !important;
            }
        }
    </style>

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "PSA鑑定代行サービス",
        "provider": {
            "@type": "Organization",
            "name": "株式会社カヌカード",
            "url": "https://kanucard.com"
        },
        "description": "PSA鑑定代行サービス。7,000枚以上のPSA10実績、70%保証プランで返金保証付き。",
        "areaServed": "JP"
    }
    </script>
</head>
<body <?php body_class( 'psa-lp-page' ); ?>>
<?php wp_body_open(); ?>

    <!-- Header -->
    <header class="site-header" id="header">
        <div class="container header-inner">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo brand-logo">kanucard</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホーム</a></li>
                    <li><a href="#features">PSA代行の特徴</a></li>
                    <li><a href="#flow">ご利用の流れ</a></li>
                    <li><a href="#plans">料金一覧</a></li>
                    <li><a href="#faq">FAQ（よくある質問）</a></li>
                </ul>
                <a href="https://daiko.kanucard.com" class="mobile-cta-link">無料見積もり</a>
            </nav>
            <a href="https://daiko.kanucard.com" class="header-cta">無料見積もり</a>
            <button class="mobile-toggle" aria-label="メニュー">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero" id="hero">
            <div class="hero-bg"></div>

            <!-- 流れる画像スライダー -->
            <div class="hero-slider">
                <div class="hero-slider-track">
                    <?php
                    $slider_images = array(
                        'https://kanucard.com/wp-content/uploads/2025/06/110627094.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/06/110627100.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/06/110627107.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/06/110627112.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/06/110627111.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/06/110627118.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/06/110627127.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/06/110627140.jpg',
                    );
                    // 2回ループしてシームレスに
                    for ($i = 0; $i < 2; $i++):
                        foreach ($slider_images as $image):
                    ?>
                    <div class="hero-slider-item">
                        <img src="<?php echo esc_url($image); ?>" alt="PSA鑑定カード">
                    </div>
                    <?php
                        endforeach;
                    endfor;
                    ?>
                </div>
            </div>

            <!-- 流れる画像スライダー 2段目（逆方向） -->
            <div class="hero-slider hero-slider-2">
                <div class="hero-slider-track hero-slider-track-reverse">
                    <?php
                    $slider_images_2 = array(
                        'https://kanucard.com/wp-content/uploads/2025/12/137366398-front.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137366395-front.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137521474-front-scaled.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137521472-front-scaled.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137521458-front-scaled.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137521455-front-scaled.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137521451-front-scaled.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137521436-front-scaled.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137521431-front-scaled.jpg',
                        'https://kanucard.com/wp-content/uploads/2025/12/137521426-front-scaled.jpg',
                    );
                    // 2回ループしてシームレスに
                    for ($i = 0; $i < 2; $i++):
                        foreach ($slider_images_2 as $image):
                    ?>
                    <div class="hero-slider-item">
                        <img src="<?php echo esc_url($image); ?>" alt="PSA鑑定カード">
                    </div>
                    <?php
                        endforeach;
                    endfor;
                    ?>
                </div>
            </div>

            <div class="container hero-content">
                <div class="hero-badge fade-in">
                    <i class="fas fa-crown"></i>
                    <span>業界トップクラス実績</span>
                </div>
                <h1 class="hero-title fade-in">
                    <span class="hero-title-line">あなたのカードの価値を、</span><br class="sp-only">
                    <span class="hero-title-line"><span class="highlight">さらに高く。</span></span><br>
                    <span class="hero-subtitle-line" style="font-size: 0.5em; font-weight: 400;">未鑑定カードを売却する前に、一度検討してください。</span><br>
                    <small><span class="hero-subtitle-line">7,000枚以上のPSA10実績が証明する</span><br><span class="hero-subtitle-line">圧倒的な技術力</span></small>
                </h1>
                <div class="hero-features fade-in delay-1">
                    <div class="hero-feature-item hero-link" onclick="var el = document.getElementById('guarantee-explanation'); if(el){ el.scrollIntoView({behavior: 'smooth', block: 'start'}); }">
                        <i class="fas fa-shield-alt"></i>
                        <span>70%保証で返金あり</span>
                    </div>
                    <div class="hero-feature-item">
                        <i class="fas fa-search"></i>
                        <span>無料検品</span>
                    </div>
                    <div class="hero-feature-item">
                        <i class="fas fa-comments"></i>
                        <span>メッセージサポート</span>
                    </div>
                </div>
                <p class="hero-subtitle fade-in delay-1">
                    <span style="font-size: 0.95em; opacity: 0.9;">失敗したくないあなたのための<br>プロフェッショナルPSA代行</span>
                </p>
                <div class="hero-stats fade-in delay-2">
                    <div class="stat-card">
                        <div class="stat-icon-wrap">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">7,000<span class="stat-unit">枚超</span></span>
                            <span class="stat-label">PSA10取得</span>
                        </div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-card">
                        <div class="stat-icon-wrap">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">90<span class="stat-unit">%超</span></span>
                            <span class="stat-label">平均PSA10率</span>
                        </div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-card stat-card-guarantee">
                        <div class="stat-icon-wrap">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number stat-text">条件付き</span>
                            <span class="stat-label">返金保証</span>
                        </div>
                    </div>
                </div>
                <div class="hero-cta fade-in delay-3">
                    <div class="access-button-wrapper">
                        <button class="btn btn-gold btn-xlarge pulse access-button" id="accessButton">
                            <i class="fas fa-arrow-right"></i> アクセスボタン
                        </button>
                        <div class="access-button-dropdown" id="accessButtonDropdown">
                            <p class="access-button-dropdown-label">ご希望の方法を選択してください</p>
                            <a href="https://daiko.kanucard.com/login" class="btn btn-gold btn-large" id="orderNowButton" target="_blank">
                                <i class="fas fa-paper-plane"></i> 今すぐ依頼
                            </a>
                            <a href="#flow" class="btn btn-white btn-large" id="checkFlowButton">
                                <i class="fas fa-list-ol"></i> 依頼手順を確認する
                            </a>
                            <button id="openEstimateModalHero" class="btn btn-gold btn-large">
                                <i class="fas fa-calculator"></i> 簡易見積もり
                            </button>
                            <a href="https://kanucard.com/guide/" class="btn btn-white btn-large" target="_blank">
                                <i class="fas fa-clipboard-list"></i> 登録方法の確認
                            </a>
                            <button id="openContactModal" class="btn btn-white btn-large">
                                <i class="fas fa-comments"></i> メッセージで気軽に相談
                            </button>
                            <a href="#review" class="btn btn-white btn-large go-to-review-section">
                                <i class="fas fa-pen"></i> 口コミを送信
                            </a>
                        </div>
                    </div>
                </div>
                <p class="hero-guarantee fade-in delay-3">
                    <i class="fas fa-check-circle"></i>
                    <span>相談無料 / 強引な営業一切なし / 24時間チャット</span>
                </p>
                <div class="scroll-indicator">
                    <span>なぜカヌカードが選ばれるのか</span>
                    <i class="fas fa-chevron-down bounce"></i>
                </div>
            </div>
        </section>

        <!-- Problem Section -->
        <section class="problem-section" id="problems">
            <div class="container">
                <h2 class="section-title">
                    こんな経験、ありませんか？
                    <small style="display: block; font-size: 0.5em; font-weight: 400; margin-top: 10px; opacity: 0.8;">
                        多くのコレクターが抱える悩み
                    </small>
                </h2>
                <div class="problems-grid">
                    <div class="problem-item" data-aos="fade-up">
                        <i class="fas fa-sad-tear"></i>
                        <p><strong>「PSA9」</strong>で戻ってきて<br>数万円損した...</p>
                    </div>
                    <div class="problem-item" data-aos="fade-up" data-delay="100">
                        <i class="fas fa-question-circle"></i>
                        <p>自分では<strong>状態の見極め</strong>が<br>できない...</p>
                    </div>
                    <div class="problem-item" data-aos="fade-up" data-delay="200">
                        <i class="fas fa-money-bill-wave"></i>
                        <p>鑑定料が<strong>高額</strong>で<br>失敗が怖い...</p>
                    </div>
                    <div class="problem-item" data-aos="fade-up" data-delay="300">
                        <i class="fas fa-plane"></i>
                        <p><strong>海外発送</strong>のトラブルが<br>心配...</p>
                    </div>
                    <div class="problem-item" data-aos="fade-up" data-delay="400">
                        <i class="fas fa-user-times"></i>
                        <p>他社代行で<strong>対応が悪く</strong><br>不信感...</p>
                    </div>
                </div>
                <p class="problems-conclusion" data-aos="fade-up" data-delay="500">
                    <i class="fas fa-arrow-down"></i>
                    <strong>これらの悩み<br>すべてカヌカードが解決します</strong>
                </p>
            </div>
        </section>

        <!-- Solution Section -->
        <section class="solution-section" id="features">
            <div class="container">
                <h2 class="section-title">
                    なぜカヌカードが選ばれるのか
                    <small style="display: block; font-size: 0.5em; font-weight: 400; margin-top: 10px;">
                        他社にはない5つの圧倒的優位性
                    </small>
                </h2>
                <div class="solutions-grid">
                    <div class="solution-card" data-aos="fade-up">
                        <div class="solution-icon">
                            <i class="fas fa-search-dollar"></i>
                        </div>
                        <h3>無料検品</h3>
                        <p>PSA10が見込めないカードは提出しない。<br>無駄な鑑定料を払わせない<br>本当の意味でのプロのサービス</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                    <div class="solution-card featured" data-aos="fade-up" data-delay="100">
                        <div class="solution-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>70%保証で一部返金</h3>
                        <p>PSA10取得率70%未満なら代行料を一部返金。<br>リスクゼロで最高グレードに挑戦できる唯一のプラン</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                    <div class="solution-card" data-aos="fade-up" data-delay="200">
                        <div class="solution-icon">
                            <i class="fas fa-flag-usa"></i>
                        </div>
                        <h3>米国PSA本社直送</h3>
                        <p>中間業者を通さない直接提出。<br>最短ルートで確実に、あなたのカードを本場の鑑定士へ</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                    <div class="solution-card" data-aos="fade-up" data-delay="300">
                        <div class="solution-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>メッセージサポート</h3>
                        <p>疑問があればすぐに解決。<br>代行アプリ内のメッセージ機能で安心の完全サポート体制</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                    <div class="solution-card" data-aos="fade-up" data-delay="400">
                        <div class="solution-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3>7,000枚以上の実績</h3>
                        <p>PSA10の取得率は90%超<br>顧客満足度の高い実績</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Results Section -->
        <section class="results-section" id="results">
            <div class="container">
                <h2 class="section-title">
                    数字が語る、圧倒的な信頼
                    <small style="display: block; font-size: 0.5em; font-weight: 400; margin-top: 10px;">
                        業界トップクラスの実績をご覧ください
                    </small>
                </h2>
                <div class="results-stats">
                    <div class="result-item" data-aos="zoom-in">
                        <div class="result-number"><span data-count="7000">0</span><small>枚超</small></div>
                        <div class="result-label">PSA10取得数</div>
                    </div>
                    <div class="result-item" data-aos="zoom-in" data-delay="100">
                        <div class="result-number">90％<small>超</small></div>
                        <div class="result-label">平均PSA10取得率</div>
                    </div>
                    <div class="result-item" data-aos="zoom-in" data-delay="200">
                        <div class="result-number"><span data-count="98">0</span><small>%</small></div>
                        <div class="result-label">顧客満足度</div>
                    </div>
                    <div class="result-item" data-aos="zoom-in" data-delay="300">
                        <div class="result-number"><span data-count="0">0</span><small>件</small></div>
                        <div class="result-label">事故・紛失</div>
                    </div>
                </div>

                <?php
                // 承認済み口コミを取得
                $approved_reviews = array();
                $all_reviews = get_option( 'psa_lp_reviews', array() );
                foreach ( $all_reviews as $rev ) {
                    if ( isset( $rev['status'] ) && $rev['status'] === 'approved' ) {
                        $approved_reviews[] = $rev;
                    }
                }
                $approved_reviews = array_reverse( $approved_reviews );
                ?>
                <div class="testimonials">
                    <h3 class="subsection-title">
                        <i class="fas fa-quote-left" style="color: var(--secondary); margin-right: 10px;"></i>
                        お客様からいただいた口コミ
                    </h3>
                    <p class="testimonials-thanks">ご利用下さったお客様<br>ありがとうございました！</p>

                    <div class="testimonial-slider-wrapper">
                        <div class="testimonial-slider">
                            <!-- 静的口コミ -->
                            <div class="testimonial-card testimonial-slide">
                                <div class="testimonial-quote">"</div>
                                <div class="testimonial-header">
                                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                                    <div class="testimonial-info">
                                        <h4>T.K 様 <small>（初回利用）</small></h4>
                                        <div class="stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="testimonial-text">
                                    <strong>検品で3枚返却されて正解でした。</strong>残り7枚は全てPSA10。もしそのまま出していたら無駄金だった。プロに任せて本当に良かった。
                                </p>
                                <p class="tap-hint"><i class="fas fa-hand-pointer"></i> タップで全文表示</p>
                                <div class="testimonial-result">
                                    <span><i class="fas fa-arrow-right"></i> PSA10取得: 7/7枚 (100%)</span>
                                </div>
                            </div>
                            <div class="testimonial-card testimonial-slide">
                                <div class="testimonial-quote">"</div>
                                <div class="testimonial-header">
                                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                                    <div class="testimonial-info">
                                        <h4>M.S 様 <small>（リピーター）</small></h4>
                                        <div class="stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="testimonial-text">
                                    70%保証プランで10枚依頼。結果は9枚PSA10、カードの価値が合計で約50万円上がった。代行料を払う価値のある投資でした。
                                </p>
                                <p class="tap-hint"><i class="fas fa-hand-pointer"></i> タップで全文表示</p>
                                <div class="testimonial-result">
                                    <span><i class="fas fa-arrow-right"></i> PSA10取得: 9/10枚 (90%)</span>
                                </div>
                            </div>
                            <div class="testimonial-card testimonial-slide">
                                <div class="testimonial-quote">"</div>
                                <div class="testimonial-header">
                                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                                    <div class="testimonial-info">
                                        <h4>Y.N 様 <small>（高額カード）</small></h4>
                                        <div class="stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="testimonial-text">
                                    100万円超のカードを依頼。アプリ内で進捗確認ができて安心感が違った。
                                </p>
                                <p class="tap-hint"><i class="fas fa-hand-pointer"></i> タップで全文表示</p>
                                <div class="testimonial-result">
                                    <span><i class="fas fa-arrow-right"></i> 価値上昇: +200万円</span>
                                </div>
                            </div>
                            <div class="testimonial-card testimonial-slide">
                                <div class="testimonial-quote">"</div>
                                <div class="testimonial-header">
                                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                                    <div class="testimonial-info">
                                        <h4>H.T 様 <small>（バリューバルク）</small></h4>
                                        <div class="stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="testimonial-text">
                                    無料検品の結果はボタンで簡単に選択でき、操作も迷わずスムーズでした。バリューバルクの送料は1枚約300円で、かなり安くアメリカPSAを利用できました。
                                </p>
                                <p class="tap-hint"><i class="fas fa-hand-pointer"></i> タップで全文表示</p>
                                <div class="testimonial-result">
                                    <span><i class="fas fa-arrow-right"></i> コスパ抜群のバリューバルク</span>
                                </div>
                            </div>

                            <!-- 動的口コミ（承認済み） -->
                            <?php foreach ( $approved_reviews as $rev ) : ?>
                            <div class="testimonial-card testimonial-slide">
                                <div class="testimonial-quote">"</div>
                                <div class="testimonial-header">
                                    <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                                    <div class="testimonial-info">
                                        <h4><?php echo esc_html( $rev['name'] ); ?> 様</h4>
                                        <div class="stars">
                                            <?php for ( $s = 0; $s < intval( $rev['rating'] ); $s++ ) : ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>
                                            <?php for ( $s = intval( $rev['rating'] ); $s < 5; $s++ ) : ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                                <p class="testimonial-text">
                                    <?php echo nl2br( esc_html( $rev['message'] ) ); ?>
                                </p>
                                <p class="tap-hint"><i class="fas fa-hand-pointer"></i> タップで全文表示</p>
                                <div class="testimonial-result">
                                    <span style="color: #888; font-size: 0.85em;">
                                        <i class="far fa-calendar-alt"></i>
                                        <?php echo esc_html( date( 'Y年n月j日', strtotime( $rev['date'] ) ) ); ?>
                                    </span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="testimonial-slider-dots"></div>
                </div>

                <!-- 口コミ全文モーダル -->
                <div class="review-detail-overlay" id="reviewDetailOverlay">
                    <div class="review-detail-modal">
                        <button class="review-detail-close" id="reviewDetailClose">&times;</button>
                        <div class="testimonial-header">
                            <div class="testimonial-avatar"><i class="fas fa-user-circle"></i></div>
                            <div class="testimonial-info">
                                <h4 id="reviewDetailName"></h4>
                                <div class="stars" id="reviewDetailStars"></div>
                            </div>
                        </div>
                        <div class="review-detail-text" id="reviewDetailText"></div>
                        <div class="review-detail-result" id="reviewDetailResult"></div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Flow Section -->
        <section class="flow-section" id="flow">
            <div class="container">
                <h2 class="section-title">
                    代行サービスご利用の流れ<br>（全6ステップ）
                </h2>

                <div class="flow-steps-vertical">
                    <!-- STEP 01 -->
                    <div class="flow-step-card" data-aos="fade-up">
                        <div class="step-header">
                            <span class="step-badge">STEP 01</span>
                            <h3>応募フォームからカード情報を入力</h3>
                        </div>
                        <div class="step-body">
                            <div class="step-image">
                                <img src="https://kanucard.com/wp-content/uploads/2026/02/step01.png" alt="STEP01 フォーム入力">
                            </div>
                            <div class="step-content">
                                <p>代行したいカード情報を入力します。個人情報・PSA社の鑑定プラン・カヌカードの代行プランなど、項目を選んでください。</p>
                                <p>内容送信後に確認メールが届きます。記載の住所にカードをお送りください！</p>
                                <div class="step-points">
                                    <h4><i class="fas fa-lightbulb"></i> POINT</h4>
                                    <ul>
                                        <li><i class="fas fa-check"></i> カードの入力は日本語でOK！英語変換して提出するのでお任せください！</li>
                                        <li><i class="fas fa-check"></i> 代行に関するご質問があれば、フォーム内の"メッセージ"にご入力ください。（例：無料検品は不要、連番指定など）</li>
                                        <li><i class="fas fa-check"></i> メールに記載のアカウント登録をお願いします！</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 02 -->
                    <div class="flow-step-card" data-aos="fade-up">
                        <div class="step-header">
                            <span class="step-badge">STEP 02</span>
                            <h3>無料検品（カードチェック）</h3>
                        </div>
                        <div class="step-body">
                            <div class="step-image">
                                <img src="https://kanucard.com/wp-content/uploads/2026/02/step02.png" alt="STEP02 無料検品">
                            </div>
                            <div class="step-content">
                                <p><strong>届いたカードは全てチェック！</strong></p>
                                <ul class="step-list">
                                    <li><i class="fas fa-check-circle"></i> 検品不要な方はそのまま提出します（70%プランは検品必須）</li>
                                    <li><i class="fas fa-check-circle"></i> PSA10が見込めるカード／見込めないカードを無料で検品します</li>
                                    <li><i class="fas fa-check-circle"></i> 日本の代行が難しくてもアメリカでPSA10の可能性がある場合はご提案します！</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 03 -->
                    <div class="flow-step-card" data-aos="fade-up">
                        <div class="step-header">
                            <span class="step-badge">STEP 03</span>
                            <h3>代行料のお支払い</h3>
                        </div>
                        <div class="step-body">
                            <div class="step-image">
                                <img src="https://kanucard.com/wp-content/uploads/2026/02/step03.png" alt="STEP03 代行料のお支払い">
                            </div>
                            <div class="step-content">
                                <p>代行するカードが確定した時点で1回目のお支払いメールをお送りします。</p>
                                <p><small>※クレジット決済・コンビニ支払い・後払い等お選びいただけます</small></p>
                                <div class="step-points">
                                    <h4><i class="fas fa-lightbulb"></i> POINT</h4>
                                    <p>カヌカードの代行ではお支払いは<strong>2分割制</strong>となっております。</p>
                                    <ul>
                                        <li><i class="fas fa-check"></i> <strong>1回目：</strong>代行料のみのお支払い</li>
                                        <li><i class="fas fa-check"></i> <strong>2回目：</strong>鑑定料などのお支払い</li>
                                    </ul>
                                    <div class="step-note">
                                        <p><strong>【2分割制の理由】</strong><br>ご依頼から鑑定品のご返却まで長期に渡り、お客様の資産をお預かりすることになります。お互いの認識違いを防ぐ目的で2分割制を採用しております。</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 04 -->
                    <div class="flow-step-card" data-aos="fade-up">
                        <div class="step-header">
                            <span class="step-badge">STEP 04</span>
                            <h3>PSA社へ発送</h3>
                        </div>
                        <div class="step-body">
                            <div class="step-image">
                                <img src="https://kanucard.com/wp-content/uploads/2026/02/step04.png" alt="STEP04 PSA社へ発送">
                            </div>
                            <div class="step-content">
                                <div class="shipping-options">
                                    <div class="shipping-option">
                                        <h4><span class="flag">🇯🇵</span> 日本支社の場合</h4>
                                        <p>鑑定会社のルールに沿って申込・発送いたします。発送後、1〜2日程で日本支社へ到着します。</p>
                                    </div>
                                    <div class="shipping-option">
                                        <h4><span class="flag">🇺🇸</span> アメリカ支社の場合</h4>
                                        <p>海外発送は少し特殊で、申告手続きが必要です。その為、アメリカ支社到着までに1〜3週間程度となります。</p>
                                        <p><strong>輸出申告、通関業務は弊社が行います。お客様の作業負担はありません。</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 05 -->
                    <div class="flow-step-card" data-aos="fade-up">
                        <div class="step-header">
                            <span class="step-badge">STEP 05</span>
                            <h3>鑑定終了</h3>
                        </div>
                        <div class="step-body">
                            <div class="step-image">
                                <img src="https://kanucard.com/wp-content/uploads/2026/02/step05.png" alt="STEP05 鑑定終了">
                            </div>
                            <div class="step-content">
                                <p>鑑定結果と共に2回目のお支払いについてご連絡します。</p>
                                <p><small>※フォーム入力時に買取額の提示を希望されたお客様にはここでご連絡しています。</small></p>
                                <div class="step-points">
                                    <h4><i class="fas fa-lightbulb"></i> POINT</h4>
                                    <ul>
                                        <li><i class="fas fa-check"></i> 2回目の決済方法は銀行振込のみとなります</li>
                                        <li><i class="fas fa-check"></i> 振込手数料はお客様ご負担となります</li>
                                        <li><i class="fas fa-check"></i> お支払い方法をクレジット決済などに変更されたいお客様は別途ご相談ください<br><small>※2回目のお支払額に対し、4%の追加手数料が発生いたします</small></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 06 -->
                    <div class="flow-step-card step-complete" data-aos="fade-up">
                        <div class="step-header">
                            <span class="step-badge complete">STEP 06</span>
                            <h3>お取引完了！</h3>
                        </div>
                        <div class="step-body">
                            <div class="step-image">
                                <img src="https://kanucard.com/wp-content/uploads/2026/02/step06.png" alt="STEP06 お取引完了">
                            </div>
                            <div class="step-content">
                                <p>お支払いが完了したお客様から順次発送します。</p>
                                <p><small>※弊社に鑑定品が到着後、平日3日以内に発送いたします。</small></p>
                                <div class="step-thanks">
                                    <span>ご利用ありがとうございました！</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flow-cta" data-aos="fade-up" data-delay="300">
                    <p style="font-size: 1.2em; font-weight: 600; margin-bottom: 20px;">
                        <i class="fas fa-hand-point-right" style="color: var(--secondary);"></i>
                        今すぐ始めて、あなたのカードの価値を最大化
                    </p>
                    <a href="https://daiko.kanucard.com" class="btn btn-primary btn-large">
                        <i class="fas fa-paper-plane"></i>
                        代行フォームへ進む
                    </a>
                </div>
            </div>
        </section>

        <!-- Access Button Before Plans -->
        <div class="access-button-section" style="text-align: center; padding: 40px 20px; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
            <div class="access-button-wrapper">
                <button class="btn btn-gold btn-xlarge pulse access-button">
                    <i class="fas fa-arrow-right"></i> アクセスボタン
                </button>
                <div class="access-button-dropdown">
                    <p class="access-button-dropdown-label">ご希望の方法を選択してください</p>
                    <a href="https://daiko.kanucard.com/login" class="btn btn-gold btn-large" target="_blank">
                        <i class="fas fa-paper-plane"></i> 今すぐ依頼
                    </a>
                    <a href="#flow" class="btn btn-white btn-large">
                        <i class="fas fa-list-ol"></i> 依頼手順を確認する
                    </a>
                    <button class="btn btn-gold btn-large open-estimate-modal">
                        <i class="fas fa-calculator"></i> 簡易見積もり
                    </button>
                    <a href="https://kanucard.com/guide/" class="btn btn-white btn-large" target="_blank">
                        <i class="fas fa-clipboard-list"></i> 登録方法の確認
                    </a>
                    <button class="btn btn-white btn-large open-contact-modal">
                        <i class="fas fa-comments"></i> メッセージで気軽に相談
                    </button>
                    <a href="#review" class="btn btn-white btn-large go-to-review-section">
                        <i class="fas fa-pen"></i> 口コミを送信
                    </a>
                </div>
            </div>
        </div>

        <!-- Plans Section -->
        <section class="plans-section" id="plans">
            <div class="container">
                <h2 class="section-title" style="color: #fff;">
                    あなたに最適なプランを選択
                    <small style="display: block; font-size: 0.5em; font-weight: 400; margin-top: 10px; opacity: 0.9;">
                        どちらも無料検品・メッセージサポート付き
                    </small>
                </h2>
                <div class="plans-grid">
                    <div class="plan-card" data-aos="fade-up">
                        <div class="plan-header">
                            <h3 class="plan-title-highlight">ノーマルプラン</h3>
                        </div>
                        <ul class="plan-features">
                            <li><i class="fas fa-check"></i> <strong>無料検品</strong>でPSA10狙いのみ提出</li>
                            <li><i class="fas fa-check"></i> <strong>メッセージサポート</strong></li>
                            <li><i class="fas fa-check"></i> <strong>米国本社</strong>へ直接提出</li>
                            <li><i class="fas fa-check"></i> <strong>進捗報告</strong>随時お知らせ</li>
                            <li class="disabled"><i class="fas fa-times"></i> 返金保証なし</li>
                        </ul>
                        <div class="plan-recommend">
                            <i class="fas fa-user"></i>
                            <span>コストを最小限に抑えたい方向け</span>
                        </div>
                        <p class="plan-popular">
                            <i class="fas fa-fire"></i>
                            <span>利用者の<strong>78%</strong>がこのプランを選択</span>
                        </p>
                    </div>
                    <div class="plan-card has-badge" data-aos="fade-up" data-delay="100">
                        <div class="plan-badge secondary">初めての方にオススメ</div>
                        <div class="plan-header">
                            <h3 class="plan-title-highlight">70%保証プラン</h3>
                        </div>
                        <ul class="plan-features">
                            <li><i class="fas fa-check"></i> <strong>無料検品</strong>でPSA10狙いのみ提出</li>
                            <li><i class="fas fa-check"></i> <strong>メッセージサポート</strong></li>
                            <li><i class="fas fa-check"></i> <strong>米国本社</strong>へ直接提出</li>
                            <li><i class="fas fa-check"></i> <strong>進捗報告</strong>随時お知らせ</li>
                            <li class="highlight"><i class="fas fa-shield-alt"></i> <strong>70%未満で一部返金</strong></li>
                        </ul>
                        <div class="plan-guarantee">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span><strong>PSA10取得率70%未満なら<br>代行料を一部返金</strong></span>
                        </div>
                        <div class="plan-recommend">
                            <i class="fas fa-gem"></i>
                            <span>失敗リスクを低くしたい方に</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Estimate Button -->
                <div class="quick-estimate-cta" data-aos="fade-up">
                    <button type="button" class="btn btn-gold btn-large" id="openEstimateModal">
                        <i class="fas fa-calculator"></i> 簡易見積もり
                    </button>
                </div>

                <!-- 70% Guarantee Explanation -->
                <div class="guarantee-explanation" data-aos="fade-up">
                    <h3 class="guarantee-title" id="guarantee-explanation">
                        <i class="fas fa-shield-alt"></i>
                        70%保証プランの仕組み
                    </h3>
                    <p class="guarantee-intro">具体例でわかりやすく解説します</p>

                    <div class="guarantee-flow">
                        <div class="guarantee-step">
                            <div class="step-icon-circle">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div class="step-number-badge">STEP 1</div>
                            <h4>無料検品後、10枚以上で依頼</h4>
                            <div class="step-illustration">
                                <div class="cards-stack">
                                    <div class="card-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/card-back.svg" alt="カード"></div>
                                    <div class="card-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/card-back.svg" alt="カード"></div>
                                    <div class="card-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/card-back.svg" alt="カード"></div>
                                    <div class="card-count">×10枚</div>
                                </div>
                            </div>
                            <p>弊社の無料検品を通過した<br><strong>10枚以上</strong>のカードをご依頼</p>
                        </div>

                        <div class="guarantee-arrow">
                            <i class="fas fa-chevron-right arrow-desktop"></i>
                            <i class="fas fa-chevron-down arrow-mobile"></i>
                        </div>

                        <div class="guarantee-step">
                            <div class="step-icon-circle warning">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="step-number-badge">STEP 2</div>
                            <h4>PSA鑑定結果を確認</h4>
                            <div class="step-illustration">
                                <div class="result-bar-container">
                                    <div class="result-bar">
                                        <div class="result-bar-psa10" style="width: 60%;">
                                            <span class="bar-label">PSA10</span>
                                            <span class="bar-count">6枚</span>
                                        </div>
                                        <div class="result-bar-other" style="width: 40%;">
                                            <span class="bar-label">9以下</span>
                                            <span class="bar-count">4枚</span>
                                        </div>
                                    </div>
                                    <div class="result-bar-legend">
                                        <span class="legend-total">10枚中</span>
                                        <span class="legend-rate">取得率 <strong>60%</strong></span>
                                    </div>
                                </div>
                            </div>
                            <p>上記の場合、4枚の代行料が<br>返金対象になります</p>
                        </div>

                        <div class="guarantee-arrow">
                            <i class="fas fa-chevron-right arrow-desktop"></i>
                            <i class="fas fa-chevron-down arrow-mobile"></i>
                        </div>

                        <div class="guarantee-step highlight">
                            <div class="step-icon-circle success">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <div class="step-number-badge success">STEP 3</div>
                            <h4>差額分を返金！</h4>
                            <p class="step-description">PSA10取得率が70％を下回った場合、該当のカードに対する代行料を返金します。</p>
                            <div class="step-illustration">
                                <div class="refund-visual">
                                    <div class="refund-visual-title">返金の仕組み（例：10枚依頼）</div>
                                    <div class="refund-visual-bar-wrapper">
                                        <div class="refund-visual-bar">
                                            <div class="bar-fill bar-psa10 animate-bar" style="height: 60%;">
                                                <span class="bar-text"><i class="fas fa-gem"></i><br>PSA10<br><strong>6枚</strong></span>
                                            </div>
                                            <div class="bar-fill bar-refund animate-bar-delay" style="height: 40%;">
                                                <span class="bar-text"><i class="fas fa-undo"></i><br>9以下<br><strong>4枚</strong></span>
                                            </div>
                                        </div>
                                        <div class="bar-scale">
                                            <span class="scale-100">100%</span>
                                            <span class="scale-70">70%</span>
                                            <span class="scale-0">0%</span>
                                        </div>
                                        <div class="guarantee-line-marker">
                                            <span class="marker-line"></span>
                                            <span class="marker-label">保証ライン 70%</span>
                                        </div>
                                    </div>
                                    <div class="refund-visual-explain">
                                        <div class="explain-item center">
                                            <span class="explain-icon success"><i class="fas fa-check"></i></span>
                                            <span>PSA10取得率 <strong>60%</strong>（6枚）</span>
                                        </div>
                                        <div class="explain-item center">
                                            <span class="explain-icon warning"><i class="fas fa-exclamation"></i></span>
                                            <span>保証ライン70%を <strong>下回った</strong></span>
                                        </div>
                                        <div class="explain-arrow"><i class="fas fa-arrow-down"></i></div>
                                        <div class="explain-item highlight center">
                                            <span><strong>4枚分</strong>の代行料を返金！</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>※上記はご利用イメージです</p>
                        </div>
                    </div>

                    <div class="guarantee-notes">
                        <h4><i class="fas fa-exclamation-triangle"></i> 70％保証プランの確認事項</h4>
                        <ul>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <div class="note-content">
                                    <span class="note-heading">ポケモンカード限定<span class="note-colon">：</span></span>
                                    <span class="note-text">70%保証プランはポケモンカードのみ対象です</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <div class="note-content">
                                    <span class="note-heading">無料検品は必須<span class="note-colon">：</span></span>
                                    <span class="note-text">検品後に10枚未満となった場合、ノーマルプランへ移行します</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <div class="note-content">
                                    <span class="note-heading">多めのご依頼推奨<span class="note-colon">：</span></span>
                                    <span class="note-text">検品で返却される可能性を考慮し、余裕を持った枚数でご依頼ください</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <div class="note-content">
                                    <span class="note-heading">返金対象は代行料のみ<span class="note-colon">：</span></span>
                                    <span class="note-text">PSA鑑定料は返金対象外となります</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="plans-note">
                    <div class="note-box pricing-flow-box">
                        <h4 style="text-align: center;"><i class="fas fa-info-circle"></i> 2回払いのシンプルなお支払い設計</h4>
                        <div class="pricing-flow">
                            <div class="pricing-step">
                                <div class="pricing-step-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <div class="pricing-step-number">1回目</div>
                                <div class="pricing-step-title">代行手数料</div>
                                <div class="pricing-step-timing">カード到着時に請求</div>
                            </div>
                            <div class="pricing-flow-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                            <div class="pricing-step">
                                <div class="pricing-step-icon">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <div class="pricing-step-number">2回目</div>
                                <div class="pricing-step-title">PSA鑑定料・返送料など</div>
                                <div class="pricing-step-timing">料金確定後に請求</div>
                            </div>
                        </div>
                        <div class="pricing-note">
                            <i class="fas fa-check-circle"></i>
                            <span>PSA鑑定料はPSA社の公式料金です</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section" id="faq">
            <div class="container">
                <h2 class="section-title">よくあるご質問</h2>
                <div class="faq-list">
                    <div class="faq-item" data-aos="fade-up">
                        <button class="faq-question">
                            <span>初めてのPSA代行で、よくわからない。不安です。</span>
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="faq-answer">
                            <p>ご安心ください。代行アプリ内のメッセージ機能で24時間対応しており、解説動画も完備しています。初心者の方でも一から丁寧にサポートいたします。</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up">
                        <button class="faq-question">
                            <span>支払い回数が2回とはどういう意味ですか？</span>
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="faq-answer">
                            <p>1回目は代行手数料（カード到着時）、2回目はPSA鑑定料と返送料などが確定した後の計2回に分けてお支払いいただきます。</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up">
                        <button class="faq-question">
                            <span>返却までの期間はどのくらいかかりますか？</span>
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="faq-answer">
                            <p>PSAのプランにより異なりますが、通常60〜180日程度です。お急ぎの場合は速達プランもございます。</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up">
                        <button class="faq-question">
                            <span>無料検品について詳しく教えてください。</span>
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="faq-answer">
                            <p>お送りいただいたカードをプロが検品し、PSA10が見込めるカードのみを厳選します。PSA9以下になりそうなカードは無料で返却します。</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up">
                        <button class="faq-question">
                            <span>どのプランで申し込めば良いかわからない。</span>
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="faq-answer">
                            <p>初めての方や高額カードをお持ちの方には「70%保証プラン」をおすすめします。代行アプリ内のメッセージでご相談いただければ、最適なプランをご提案いたします。</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up">
                        <button class="faq-question">
                            <span>発送方法に指定はありますか？</span>
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="faq-answer">
                            <p>弊社へのカード発送方法に特に指定はございません。お好きな配送業者をご利用いただけます。ただし、必着期限ギリギリの場合は、配送状況が確認しやすいヤマト運輸のご利用をおすすめします。</p>
                        </div>
                    </div>
                    <div class="faq-item" data-aos="fade-up">
                        <button class="faq-question">
                            <span>カードセイバーは必要ですか？</span>
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="faq-answer">
                            <p>カードセイバーをお持ちでなくても大丈夫です。PSA提出に必要な資材は弊社でご用意しております。無料検品をご希望の場合は、カードにスリーブを装着し、厚紙やデッキケースなどで保護して輸送事故に配慮した梱包でお送りください。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Review Form Section -->
        <section class="review-form-section" id="review">
            <div class="container">
                <h2 class="section-title">
                    <i class="fas fa-pen" style="color: var(--secondary); margin-right: 10px;"></i>
                    あなたの声をお聞かせください
                </h2>
                <p class="review-form-intro">ご利用いただいた感想やご意見をお待ちしております</p>

                <?php
                // URLパラメータで成功状態を確認（リダイレクト後）
                $review_success = isset($_GET['review_submitted']) && $_GET['review_submitted'] === '1';
                $review_error = $psa_review_error; // テンプレート上部で設定されたエラー
                ?>

                <div class="review-modal-overlay" id="reviewSuccessModal" style="display: none;">
                    <div class="review-modal-content">
                        <i class="fas fa-check-circle"></i>
                        <p>口コミをご投稿いただき、ありがとうございました！<br>内容を確認の上、掲載させていただきます。</p>
                        <button type="button" class="btn btn-success-dismiss" id="reviewModalCloseBtn">
                            確認
                        </button>
                    </div>
                </div>
                <script>
                    (function() {
                        // URLパラメータをチェック
                        var urlParams = new URLSearchParams(window.location.search);
                        if (urlParams.get('review_submitted') === '1') {
                            // モーダルを表示
                            document.getElementById('reviewSuccessModal').style.display = 'flex';
                            // 即座にURLパラメータを削除（リロードなし）
                            var cleanUrl = window.location.pathname + '#review';
                            window.history.replaceState({}, document.title, cleanUrl);
                        }

                        // 確認ボタンのクリックでモーダルを閉じる
                        document.getElementById('reviewModalCloseBtn').addEventListener('click', function() {
                            document.getElementById('reviewSuccessModal').style.display = 'none';
                        });
                    })();
                </script>

                <?php if ($review_error): ?>
                    <div class="review-error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p><?php echo esc_html($review_error); ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" class="review-form" id="reviewForm">
                    <?php wp_nonce_field('psa_review_form', 'psa_review_nonce'); ?>

                    <div class="form-group">
                        <label for="review_name">
                            <i class="fas fa-user"></i> お名前<span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="review_name"
                            name="review_name"
                            placeholder="例: 山田 太郎"
                            maxlength="50"
                            required
                            value="<?php echo isset($_POST['review_name']) ? esc_attr($_POST['review_name']) : ''; ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="review_email">
                            <i class="fas fa-envelope"></i> メールアドレス<span class="required">*</span>
                        </label>
                        <input
                            type="email"
                            id="review_email"
                            name="review_email"
                            placeholder="例: example@email.com"
                            maxlength="254"
                            required
                            value="<?php echo isset($_POST['review_email']) ? esc_attr($_POST['review_email']) : ''; ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-star"></i> 評価<span class="required">*</span>
                        </label>
                        <div class="star-rating-input">
                            <input type="radio" id="star5" name="review_rating" value="5" required>
                            <label for="star5" title="5つ星"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star4" name="review_rating" value="4">
                            <label for="star4" title="4つ星"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star3" name="review_rating" value="3">
                            <label for="star3" title="3つ星"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star2" name="review_rating" value="2">
                            <label for="star2" title="2つ星"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star1" name="review_rating" value="1">
                            <label for="star1" title="1つ星"><i class="fas fa-star"></i></label>
                        </div>
                        <p class="rating-description">クリックして評価してください</p>
                    </div>

                    <div class="form-group">
                        <label for="review_message">
                            <i class="fas fa-comment"></i> ご感想・メッセージ<span class="required">*</span>
                        </label>
                        <textarea
                            id="review_message"
                            name="review_message"
                            rows="5"
                            placeholder="ご利用いただいた感想やご意見をお聞かせください..."
                            maxlength="1000"
                            required
                        ><?php echo isset($_POST['review_message']) ? esc_textarea($_POST['review_message']) : ''; ?></textarea>
                        <p class="char-count"><span id="charCount">0</span> / 1000文字</p>
                    </div>

                    <div class="form-submit">
                        <button type="submit" name="submit_review" class="btn btn-primary btn-large">
                            <i class="fas fa-paper-plane"></i>
                            口コミを投稿する
                        </button>
                        <p class="form-note">※管理者に内容が送信されます</p>
                    </div>
                </form>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="final-cta-simple" id="cta">
            <div class="container">
                <h2>まずは無料相談から始めてみませんか？</h2>
                <p>「何から始めればいいの？」そんな疑問も大歓迎。<br>専任スタッフが丁寧にご説明します。</p>
                <div class="cta-buttons-simple">
                    <a href="https://daiko.kanucard.com" class="btn btn-gold btn-xlarge">
                        簡易見積もり
                    </a>
                </div>
                <div class="trust-badges cta-trust-badges">
                    <div class="trust-badge">
                        <i class="fas fa-building"></i>
                        <span>株式会社カヌカード<br>法人運営</span>
                    </div>
                    <div class="trust-badge">
                        <i class="fas fa-certificate"></i>
                        <span>古物商許可<br>第62212R057829号</span>
                    </div>
                    <div class="trust-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>賠償責任保険<br>加入済み</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-company">
                    <h4>株式会社カヌカード</h4>
                    <p>古物商許可番号: 第62212R057829号</p>
                    <p><i class="fas fa-envelope"></i> contact@kanucard.com</p>
                </div>
                <div class="footer-links">
                    <h4>サービス</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">メインサイト</a></li>
                        <li><a href="https://daiko.kanucard.com">代行フォーム</a></li>
                        <li><a href="https://daiko.kanucard.com">メッセージ相談</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>情報</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">プライバシーポリシー</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">利用規約</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/tokusho/' ) ); ?>">特定商取引法</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h4>フォローする</h4>
                    <div class="social-links">
                        <a href="#" aria-label="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date( 'Y' ); ?> 株式会社カヌカード. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Estimate Modal -->
    <div class="estimate-modal" id="estimateModal">
        <div class="estimate-modal-overlay"></div>
        <div class="estimate-modal-content">
            <div class="estimate-modal-header">
                <button type="button" class="estimate-modal-close" id="closeEstimateModal">
                    <i class="fas fa-times"></i>
                </button>
                <h3 class="estimate-modal-title">
                    <i class="fas fa-calculator"></i> 簡易見積もり
                </h3>
                <p class="estimate-modal-desc">代行料金の目安を計算できます</p>
            </div>

            <form class="estimate-form" id="estimateForm">
                <div class="estimate-form-group">
                    <label for="agencyPlan">代行プラン</label>
                    <select id="agencyPlan" required>
                        <option value="">選択してください</option>
                        <option value="5.7" data-region="japan">日本 ノーマル</option>
                        <option value="6.8" data-region="japan">日本 70%保証</option>
                        <option value="6.8" data-region="usa">アメリカ ノーマル</option>
                        <option value="8.5" data-region="usa">アメリカ 70%保証</option>
                    </select>
                </div>

                <div class="estimate-form-group">
                    <label for="psaPlan">PSA社のプラン</label>
                    <select id="psaPlan" required disabled>
                        <option value="">先に代行プランを選択してください</option>
                    </select>
                </div>

                <div class="estimate-form-group">
                    <label for="cardCount">提出枚数</label>
                    <input type="tel" id="cardCount" placeholder="例: 10" required>
                </div>

                <div class="estimate-form-group">
                    <label for="cardValue">カードの合計申告額</label>
                    <div class="input-with-unit">
                        <input type="tel" id="cardValue" placeholder="例: 100,000" required>
                        <span class="unit">円</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-gold btn-large estimate-submit">
                    計算する
                </button>
            </form>

            <div class="estimate-result" id="estimateResult" style="display: none;">
                <h4>見積もり結果</h4>
                <div class="estimate-result-items">
                    <div class="estimate-result-item">
                        <span class="label">PSA鑑定料</span>
                        <span class="value" id="resultPsaFee">-</span>
                    </div>
                    <div class="estimate-result-item">
                        <span class="label">代行手数料</span>
                        <span class="value" id="resultAgencyFee">-</span>
                    </div>
                    <div class="estimate-result-item" id="resultCustomsTaxRow" style="display: none;">
                        <span class="label">見込み関税額（申告額の10％）</span>
                        <span class="value" id="resultCustomsTax">-</span>
                    </div>
                    <div class="estimate-result-item">
                        <span class="label">送料</span>
                        <span class="value">※1</span>
                    </div>
                    <div class="estimate-result-item total">
                        <span class="label">合計（税抜）</span>
                        <span class="value" id="resultTotal">-</span>
                    </div>
                </div>
                <p class="estimate-note">※1 送料負担額はご依頼プランによって異なります</p>
                <p class="estimate-note">※ 為替レートや送料等により実際の金額は変動します</p>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="contact-modal" id="contactModal">
        <div class="contact-modal-overlay"></div>
        <div class="contact-modal-content">
            <button type="button" class="contact-modal-close" id="closeContactModal">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="contact-modal-title">
                <i class="fas fa-comments"></i> お問い合わせ
            </h3>
            <p class="contact-modal-desc">ご質問・ご相談はこちらからお気軽にどうぞ</p>

            <?php if ($psa_contact_success): ?>
                <div class="contact-success-message">
                    <i class="fas fa-check-circle"></i>
                    <p>お問い合わせを送信しました。<br>24時間以内にご返信いたします。</p>
                </div>
            <?php else: ?>
                <?php if ($psa_contact_error): ?>
                    <div class="contact-error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span><?php echo esc_html($psa_contact_error); ?></span>
                    </div>
                <?php endif; ?>

                <form method="post" class="contact-form" id="contactForm">
                    <?php wp_nonce_field('psa_contact_form', 'psa_contact_nonce'); ?>

                    <div class="contact-form-group">
                        <label for="contact_name">
                            <i class="fas fa-user"></i> お名前 <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="contact_name"
                            name="contact_name"
                            placeholder="例: 山田 太郎"
                            maxlength="50"
                            required
                            value="<?php echo isset($_POST['contact_name']) ? esc_attr($_POST['contact_name']) : ''; ?>"
                        >
                    </div>

                    <div class="contact-form-group">
                        <label for="contact_email">
                            <i class="fas fa-envelope"></i> メールアドレス <span class="required">*</span>
                        </label>
                        <input
                            type="email"
                            id="contact_email"
                            name="contact_email"
                            placeholder="例: example@email.com"
                            maxlength="100"
                            required
                            value="<?php echo isset($_POST['contact_email']) ? esc_attr($_POST['contact_email']) : ''; ?>"
                        >
                    </div>

                    <div class="contact-form-group">
                        <label for="contact_message">
                            <i class="fas fa-comment-dots"></i> お問い合わせ内容 <span class="required">*</span>
                        </label>
                        <textarea
                            id="contact_message"
                            name="contact_message"
                            rows="5"
                            placeholder="ご質問やご相談内容をご記入ください..."
                            maxlength="2000"
                            required
                        ><?php echo isset($_POST['contact_message']) ? esc_textarea($_POST['contact_message']) : ''; ?></textarea>
                    </div>

                    <button type="submit" name="submit_contact" class="btn btn-primary btn-large contact-submit">
                        <i class="fas fa-paper-plane"></i> 送信する
                    </button>
                    <p class="contact-note">※ 確認次第、ご返信します。</p>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Fixed CTA Buttons -->
    <div class="fixed-cta-container">
        <a href="https://daiko.kanucard.com" class="fixed-cta-btn fixed-cta-primary">
            <i class="fas fa-paper-plane"></i>
            <span>代行フォームへ進む</span>
        </a>
        <a href="#flow" class="fixed-cta-btn fixed-cta-outline">
            <i class="fas fa-list-ol"></i>
            <span>依頼手順を確認する</span>
        </a>
    </div>

    <!-- PSA LP Scripts -->
    <script src="<?php echo $theme_url; ?>/psa-lp/js/script.js?v=<?php echo time(); ?>"></script>

    <?php wp_footer(); ?>
</body>
</html>