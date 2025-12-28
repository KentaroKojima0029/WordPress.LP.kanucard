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
            .testimonial-card,
            .flow-step {
                width: 100% !important;
                max-width: none !important;
                min-width: auto !important;
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
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    ?>
                    <img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="150" height="40">
                <?php else : ?>
                    <img src="https://kanucard.com/wp-content/uploads/2024/01/logo.png" alt="カヌカード" width="150" height="40">
                <?php endif; ?>
            </a>
            <nav class="main-nav">
                <ul>
                    <li><a href="#features">特徴</a></li>
                    <li><a href="#flow">流れ</a></li>
                    <li><a href="#plans">料金</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
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

            <div class="container hero-content">
                <div class="hero-badge fade-in">
                    <i class="fas fa-crown"></i>
                    <span>業界トップクラス実績</span>
                </div>
                <h1 class="hero-title fade-in">
                    <span class="hero-title-line">あなたのカードの価値を、</span><br class="sp-only">
                    <span class="hero-title-line"><span class="highlight">さらに高く。</span></span><br>
                    <small><span class="hero-subtitle-line">7,000枚以上のPSA10実績が証明する、</span><br class="sp-only"><span class="hero-subtitle-line">圧倒的な技術力</span></small>
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
                        <span>24時間メッセージサポート</span>
                    </div>
                </div>
                <p class="hero-subtitle fade-in delay-1">
                    <span style="font-size: 0.95em; opacity: 0.9;">失敗したくないあなたのための、プロフェッショナルPSA代行</span>
                </p>
                <div class="hero-stats fade-in delay-2">
                    <div class="stat-item">
                        <i class="fas fa-trophy"></i>
                        <span class="stat-number">7,000+</span>
                        <span class="stat-label">PSA10取得</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-percentage"></i>
                        <span class="stat-number">75%</span>
                        <span class="stat-label">平均PSA10率</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-shield-alt"></i>
                        <span class="stat-number">一部返金</span>
                        <span class="stat-label">保証付き</span>
                    </div>
                </div>
                <div class="hero-cta fade-in delay-3">
                    <a href="https://daiko.kanucard.com" class="btn btn-gold btn-large pulse">
                        今すぐ無料見積もりを取得
                    </a>
                    <a href="https://daiko.kanucard.com" class="btn btn-white btn-large">
                        メッセージで気軽に相談
                    </a>
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
                    <strong>これらの悩み、すべてカヌカードが解決します</strong>
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
                        <h3>業界唯一の無料検品</h3>
                        <p><strong>PSA10が見込めないカードは提出しません。</strong>無駄な鑑定料を払わせない、本当の意味でのプロのサービス</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                    <div class="solution-card featured" data-aos="fade-up" data-delay="100">
                        <div class="solution-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>70%保証で一部返金</h3>
                        <p><strong>PSA10取得率70%未満なら代行料を一部返金。</strong>リスクゼロで最高グレードに挑戦できる唯一のプラン</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                    <div class="solution-card" data-aos="fade-up" data-delay="200">
                        <div class="solution-icon">
                            <i class="fas fa-flag-usa"></i>
                        </div>
                        <h3>米国PSA本社直送</h3>
                        <p><strong>中間業者を通さない直接提出。</strong>最短ルートで確実に、あなたのカードを本場の鑑定士へ</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                    <div class="solution-card" data-aos="fade-up" data-delay="300">
                        <div class="solution-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>24時間メッセージサポート</h3>
                        <p><strong>疑問があればすぐに解決。</strong>代行アプリ内のメッセージ機能で安心の完全サポート体制、解説動画も無料提供</p>
                        <span class="check-badge"><i class="fas fa-check"></i></span>
                    </div>
                    <div class="solution-card" data-aos="fade-up" data-delay="400">
                        <div class="solution-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3>7,000枚以上の実績</h3>
                        <p><strong>数字が証明する信頼性。</strong>平均PSA10取得率75%、顧客満足度98%の圧倒的な実績</p>
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
                        <div class="result-number" data-count="7000">0</div>
                        <div class="result-label">PSA10取得数<br><small>枚以上</small></div>
                    </div>
                    <div class="result-item" data-aos="zoom-in" data-delay="100">
                        <div class="result-number" data-count="75">0</div>
                        <div class="result-label">平均PSA10取得率<br><small>%</small></div>
                    </div>
                    <div class="result-item" data-aos="zoom-in" data-delay="200">
                        <div class="result-number" data-count="98">0</div>
                        <div class="result-label">顧客満足度<br><small>%</small></div>
                    </div>
                    <div class="result-item" data-aos="zoom-in" data-delay="300">
                        <div class="result-number" data-count="0">0</div>
                        <div class="result-label">事故・紛失<br><small>件</small></div>
                    </div>
                </div>

                <div class="testimonials">
                    <h3 class="subsection-title">
                        <i class="fas fa-quote-left" style="color: var(--secondary); margin-right: 10px;"></i>
                        実際にご利用いただいたお客様の声
                    </h3>
                    <div class="testimonials-grid">
                        <div class="testimonial-card" data-aos="fade-up">
                            <div class="testimonial-quote">"</div>
                            <div class="testimonial-header">
                                <div class="testimonial-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="testimonial-info">
                                    <h4>T.K. 様 <small>（初回利用）</small></h4>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="testimonial-text">
                                <strong>検品で3枚返却されて正解でした。</strong>残り7枚は全てPSA10。もしそのまま出していたら無駄金だった。プロに任せて本当に良かった。
                            </p>
                            <div class="testimonial-result">
                                <span><i class="fas fa-arrow-right"></i> PSA10取得: 7/7枚 (100%)</span>
                            </div>
                        </div>
                        <div class="testimonial-card" data-aos="fade-up" data-delay="100">
                            <div class="testimonial-quote">"</div>
                            <div class="testimonial-header">
                                <div class="testimonial-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="testimonial-info">
                                    <h4>M.S. 様 <small>（リピーター）</small></h4>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="testimonial-text">
                                70%保証プランで10枚依頼。<strong>結果は8枚PSA10、カードの価値が合計で約50万円上がった。</strong>代行料2%なんて安すぎる投資でした。
                            </p>
                            <div class="testimonial-result">
                                <span><i class="fas fa-arrow-right"></i> PSA10取得: 8/10枚 (80%)</span>
                            </div>
                        </div>
                        <div class="testimonial-card" data-aos="fade-up" data-delay="200">
                            <div class="testimonial-quote">"</div>
                            <div class="testimonial-header">
                                <div class="testimonial-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="testimonial-info">
                                    <h4>Y.N. 様 <small>（高額カード）</small></h4>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="testimonial-text">
                                100万円超のカードを依頼。<strong>アプリ内メッセージで毎回進捗報告があり安心感が違った。</strong>無事PSA10で戻り、300万円で売却成功。信頼できるプロです。
                            </p>
                            <div class="testimonial-result">
                                <span><i class="fas fa-arrow-right"></i> 価値上昇: +200万円</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review Form Section -->
                <div class="review-form-section" data-aos="fade-up">
                    <h3 class="subsection-title">
                        <i class="fas fa-pen" style="color: var(--secondary); margin-right: 10px;"></i>
                        あなたの声をお聞かせください
                    </h3>
                    <p class="review-form-intro">ご利用いただいた感想やご意見をお待ちしております</p>

                    <?php
                    $review_success = false;
                    $review_error = '';

                    if (isset($_POST['submit_review']) && check_admin_referer('psa_review_form', 'psa_review_nonce')) {
                        $review_name = sanitize_text_field($_POST['review_name']);
                        $review_rating = intval($_POST['review_rating']);
                        $review_message = sanitize_textarea_field($_POST['review_message']);

                        if (empty($review_name) || empty($review_rating) || empty($review_message)) {
                            $review_error = 'すべての項目を入力してください。';
                        } elseif ($review_rating < 1 || $review_rating > 5) {
                            $review_error = '評価は1〜5の範囲で選択してください。';
                        } else {
                            // メール送信
                            $to = 'collection@kanucard.com';
                            $subject = 'PSA代行LPに新しい口コミが投稿されました';
                            $message = "PSA代行LPに新しい口コミが投稿されました。\n\n";
                            $message .= "お名前: " . $review_name . "\n";
                            $message .= "評価: " . str_repeat('★', $review_rating) . str_repeat('☆', 5 - $review_rating) . " (" . $review_rating . "/5)\n";
                            $message .= "メッセージ:\n" . $review_message . "\n\n";
                            $message .= "投稿日時: " . current_time('Y-m-d H:i:s') . "\n";
                            $message .= "投稿元URL: " . get_permalink() . "\n";

                            $headers = array('Content-Type: text/plain; charset=UTF-8');

                            if (wp_mail($to, $subject, $message, $headers)) {
                                $review_success = true;
                            } else {
                                $review_error = '送信に失敗しました。しばらくしてから再度お試しください。';
                            }
                        }
                    }
                    ?>

                    <?php if ($review_success): ?>
                        <div class="review-success-message">
                            <i class="fas fa-check-circle"></i>
                            <p>口コミをご投稿いただき、ありがとうございました！<br>内容を確認の上、掲載させていただきます。</p>
                        </div>
                    <?php else: ?>
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
                            </div>
                        </form>
                    <?php endif; ?>
                </div>

                <!-- PSA Graded Cards Gallery -->
                <div class="graded-gallery-section" data-aos="fade-up">
                    <h3 class="subsection-title">
                        <i class="fas fa-images" style="color: var(--secondary); margin-right: 10px;"></i>
                        実際にPSA10を取得したカードたち
                    </h3>
                    <p class="gallery-intro">7,000枚以上のPSA10実績の一部をご紹介</p>

                    <div class="gallery-scroll-container">
                        <div class="gallery-cards">
                            <!-- カード画像のプレースホルダー。実際の画像URLに差し替えてください -->
                            <div class="gallery-card">
                                <img src="https://kanucard.com/wp-content/uploads/psa-cards/card-1.jpg" alt="PSA10鑑定品" loading="lazy">
                            </div>
                            <div class="gallery-card">
                                <img src="https://kanucard.com/wp-content/uploads/psa-cards/card-2.jpg" alt="PSA10鑑定品" loading="lazy">
                            </div>
                            <div class="gallery-card">
                                <img src="https://kanucard.com/wp-content/uploads/psa-cards/card-3.jpg" alt="PSA10鑑定品" loading="lazy">
                            </div>
                            <div class="gallery-card">
                                <img src="https://kanucard.com/wp-content/uploads/psa-cards/card-4.jpg" alt="PSA10鑑定品" loading="lazy">
                            </div>
                            <div class="gallery-card">
                                <img src="https://kanucard.com/wp-content/uploads/psa-cards/card-5.jpg" alt="PSA10鑑定品" loading="lazy">
                            </div>
                            <div class="gallery-card">
                                <img src="https://kanucard.com/wp-content/uploads/psa-cards/card-6.jpg" alt="PSA10鑑定品" loading="lazy">
                            </div>
                        </div>
                    </div>
                    <p class="gallery-note">
                        <i class="fas fa-arrow-left"></i>
                        <span>スクロールして他のカードも見る</span>
                        <i class="fas fa-arrow-right"></i>
                    </p>
                </div>

                <div class="trust-badges">
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

        <!-- Flow Section -->
        <section class="flow-section" id="flow">
            <div class="container">
                <h2 class="section-title">
                    たった3ステップ、5分で完了
                    <small style="display: block; font-size: 0.5em; font-weight: 400; margin-top: 10px;">
                        あとはプロにお任せください
                    </small>
                </h2>
                <div class="flow-steps">
                    <div class="flow-step" data-aos="fade-right">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <div class="step-content">
                            <h3>フォーム入力・発送</h3>
                            <p>簡単フォームに入力後、カードを弊社へ発送。<strong>梱包方法も動画で解説</strong></p>
                            <span class="step-time"><i class="fas fa-clock"></i> たった5分</span>
                        </div>
                    </div>
                    <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                    <div class="flow-step" data-aos="fade-up">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <div class="step-content">
                            <h3>プロ検品・米国直送</h3>
                            <p><strong>PSA10が狙えるカードのみ厳選</strong>、米国PSA本社へ直接提出</p>
                            <span class="step-time"><i class="fas fa-clock"></i> 1-3日で提出</span>
                        </div>
                    </div>
                    <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                    <div class="flow-step" data-aos="fade-left">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <div class="step-content">
                            <h3>PSA10を受け取る</h3>
                            <p><strong>完璧な梱包で安全にお届け</strong>、アプリ内メッセージで進捗もお知らせ</p>
                            <span class="step-time"><i class="fas fa-clock"></i> 60-180日（プラン選択可）</span>
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
                            <h3>ノーマルプラン</h3>
                            <div class="plan-price">
                                <span class="price-main">1<small>%</small></span>
                                <span class="price-sub">代行手数料のみ</span>
                            </div>
                        </div>
                        <ul class="plan-features">
                            <li><i class="fas fa-check"></i> <strong>無料検品</strong>でPSA10狙いのみ提出</li>
                            <li><i class="fas fa-check"></i> <strong>24時間メッセージ</strong>サポート</li>
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
                            <h3>70%保証プラン</h3>
                            <div class="plan-price">
                                <span class="price-main">2<small>%</small></span>
                                <span class="price-sub">リスクゼロの安心価格</span>
                            </div>
                        </div>
                        <ul class="plan-features">
                            <li><i class="fas fa-check"></i> <strong>無料検品</strong>でPSA10狙いのみ提出</li>
                            <li><i class="fas fa-check"></i> <strong>24時間メッセージ</strong>サポート</li>
                            <li><i class="fas fa-check"></i> <strong>米国本社</strong>へ直接提出</li>
                            <li><i class="fas fa-check"></i> <strong>進捗報告</strong>随時お知らせ</li>
                            <li class="highlight"><i class="fas fa-shield-alt"></i> <strong>70%未満で一部返金</strong></li>
                        </ul>
                        <div class="plan-guarantee">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span><strong>PSA10取得率70%未満なら<br>代行料を100%返金</strong></span>
                        </div>
                        <div class="plan-recommend">
                            <i class="fas fa-gem"></i>
                            <span>失敗リスクを限りなく低くしたい方に</span>
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
                                    <div class="card-item"><i class="fas fa-id-card"></i></div>
                                    <div class="card-item"><i class="fas fa-id-card"></i></div>
                                    <div class="card-item"><i class="fas fa-id-card"></i></div>
                                    <div class="card-count">×10枚</div>
                                </div>
                            </div>
                            <p>弊社の無料検品を通過した<br><strong>10枚以上</strong>のカードをご依頼</p>
                        </div>

                        <div class="guarantee-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>

                        <div class="guarantee-step">
                            <div class="step-icon-circle warning">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="step-number-badge">STEP 2</div>
                            <h4>PSA鑑定結果を確認</h4>
                            <div class="step-illustration">
                                <div class="result-display">
                                    <div class="result-psa10">
                                        <span class="result-grade">PSA10</span>
                                        <span class="result-count">6枚</span>
                                    </div>
                                    <div class="result-other">
                                        <span class="result-grade">PSA9以下</span>
                                        <span class="result-count">4枚</span>
                                    </div>
                                </div>
                            </div>
                            <p>10枚中6枚がPSA10...<br><strong>取得率60%</strong>（70%未満）</p>
                        </div>

                        <div class="guarantee-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>

                        <div class="guarantee-step highlight">
                            <div class="step-icon-circle success">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <div class="step-number-badge success">STEP 3</div>
                            <h4>差額分を返金！</h4>
                            <div class="step-illustration">
                                <div class="refund-calculation">
                                    <div class="calc-item">
                                        <span>保証ライン</span>
                                        <strong>70%</strong>
                                    </div>
                                    <div class="calc-minus">−</div>
                                    <div class="calc-item">
                                        <span>実際の取得率</span>
                                        <strong>60%</strong>
                                    </div>
                                    <div class="calc-equals">=</div>
                                    <div class="calc-result">
                                        <span>返金率</span>
                                        <strong class="refund-amount">40%</strong>
                                    </div>
                                </div>
                            </div>
                            <p><strong>代行料の40%を返金！</strong><br>リスクを最小限に抑えられます</p>
                        </div>
                    </div>

                    <div class="guarantee-notes">
                        <h4><i class="fas fa-exclamation-triangle"></i> 70％保証プランご利用の確認事項</h4>
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
                    <div class="note-box">
                        <h4><i class="fas fa-info-circle"></i> 料金の仕組み（シンプル）</h4>
                        <p>
                            <strong>1回目:</strong> 代行手数料（カード到着時に請求）<br>
                            <strong>2回目:</strong> PSA鑑定料・返送料（提出前に請求）<br>
                            <small>※ PSA鑑定料はPSA社の公式料金です</small>
                        </p>
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
                            <p>1回目は代行手数料（カード到着時）、2回目はPSA鑑定料と返送料（PSA提出前）の2回に分けてお支払いいただきます。</p>
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
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="final-cta-section" id="cta">
            <div class="container">
                <div class="cta-content" data-aos="fade-up">
                    <div class="cta-urgency">
                        <i class="fas fa-clock"></i>
                        <span>カードの価値は時間とともに変動します</span>
                    </div>
                    <h2>
                        今すぐ、あなたのカードの<br class="sp-only">
                        <span style="color: var(--secondary);">真の価値</span>を解き放つ
                    </h2>
                    <p class="cta-subtitle">
                        <strong>PSA10を取得した瞬間、カードの価値は劇的に上昇。</strong><br>
                        7,000枚以上の実績を持つプロが、あなたの大切なカードを最高グレードへ導きます。
                    </p>
                    <div class="cta-buttons">
                        <a href="https://daiko.kanucard.com" class="btn btn-gold btn-xlarge pulse">
                            <i class="fas fa-rocket"></i>
                            無料で見積もりを取得する
                        </a>
                        <a href="https://daiko.kanucard.com" class="btn btn-secondary btn-large">
                            <i class="fas fa-comments"></i>
                            まずはメッセージで質問する
                        </a>
                    </div>
                    <div class="cta-badges">
                        <span class="cta-badge"><i class="fas fa-comment-dots"></i> 相談完全無料</span>
                        <span class="cta-badge"><i class="fas fa-microscope"></i> プロ検品無料</span>
                        <span class="cta-badge"><i class="fas fa-hand-holding-usd"></i> 70%保証で返金</span>
                        <span class="cta-badge"><i class="fas fa-user-shield"></i> 強引な営業なし</span>
                    </div>
                    <p class="cta-guarantee">
                        <i class="fas fa-check-circle"></i>
                        <strong>24時間以内</strong>にご連絡いたします
                    </p>
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
                    <p><i class="fas fa-envelope"></i> info@kanucard.com</p>
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
            <button type="button" class="estimate-modal-close" id="closeEstimateModal">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="estimate-modal-title">
                <i class="fas fa-calculator"></i> 簡易見積もり
            </h3>
            <p class="estimate-modal-desc">代行料金の目安を計算できます</p>

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
                    <input type="number" id="cardCount" min="1" max="1000" placeholder="例: 10" required>
                </div>

                <div class="estimate-form-group">
                    <label for="cardValue">カードの申告額（税抜合計）</label>
                    <div class="input-with-unit">
                        <input type="number" id="cardValue" min="0" placeholder="例: 100000" required>
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
                    <div class="estimate-result-item total">
                        <span class="label">合計（税抜）</span>
                        <span class="value" id="resultTotal">-</span>
                    </div>
                </div>
                <p class="estimate-note">※ 為替レートや送料等により実際の金額は変動します</p>
            </div>
        </div>
    </div>

    <!-- PSA LP Scripts -->
    <script src="<?php echo $theme_url; ?>/psa-lp/js/script.js?v=<?php echo time(); ?>"></script>

    <?php wp_footer(); ?>
</body>
</html>