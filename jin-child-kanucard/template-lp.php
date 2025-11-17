<?php
/**
 * Template Name: Landing Page
 * Template Post Type: page
 *
 * カスタムランディングページテンプレート
 * JINのヘッダー・フッターを使用せず、独立したLPを表示
 *
 * @package JIN_Child_Kanucard
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="lp-wrapper" class="lp-site">
    <!-- LPヘッダー -->
    <header id="lp-header" class="lp-header">
        <div class="lp-container lp-header-container">
            <div class="lp-site-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lp-site-logo">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <nav id="lp-navigation" class="lp-main-navigation">
                <ul>
                    <li><a href="#features">特徴</a></li>
                    <li><a href="#services">サービス</a></li>
                    <li><a href="#testimonials">お客様の声</a></li>
                    <li><a href="#contact">お問い合わせ</a></li>
                </ul>
            </nav>

            <div class="lp-header-cta">
                <a href="#contact" class="lp-cta-button">無料相談</a>
            </div>

            <button class="lp-mobile-menu-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <main id="lp-main" class="lp-site-main">
        <!-- ヒーローセクション -->
        <section id="hero" class="lp-hero-section">
            <div class="lp-container">
                <div class="lp-hero-content" data-aos="fade-up">
                    <h1 class="lp-hero-title">
                        あなたのビジネスを次のレベルへ
                    </h1>
                    <p class="lp-hero-subtitle">
                        革新的なソリューションで成功を実現します
                    </p>
                    <div class="lp-hero-buttons">
                        <a href="#contact" class="lp-btn-primary">無料相談</a>
                        <a href="#features" class="lp-btn-secondary">詳しく見る</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 特徴セクション -->
        <section id="features" class="lp-features-section">
            <div class="lp-container">
                <h2 class="lp-section-title" data-aos="fade-up">サービスの特徴</h2>
                <div class="lp-features-grid">
                    <div class="lp-feature-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="lp-feature-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="lp-feature-title">高速パフォーマンス</h3>
                        <p class="lp-feature-description">
                            最先端の技術を活用し、高速で安定したサービスを提供します。
                        </p>
                    </div>
                    <div class="lp-feature-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="lp-feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="lp-feature-title">セキュリティ重視</h3>
                        <p class="lp-feature-description">
                            業界最高水準のセキュリティ対策で、お客様のデータを安全に保護します。
                        </p>
                    </div>
                    <div class="lp-feature-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="lp-feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="lp-feature-title">24/7サポート</h3>
                        <p class="lp-feature-description">
                            専門チームが24時間365日体制でサポートいたします。
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- サービス詳細セクション -->
        <section id="services" class="lp-services-section">
            <div class="lp-container">
                <div class="lp-services-content">
                    <div class="lp-services-text" data-aos="fade-right">
                        <h2 class="lp-section-title">なぜ私たちを選ぶのか</h2>
                        <p class="lp-services-description">
                            10年以上の実績と、1000社以上のお客様にご利用いただいています。
                        </p>
                        <ul class="lp-services-list">
                            <li><i class="fas fa-check"></i> 専門家チームによる徹底サポート</li>
                            <li><i class="fas fa-check"></i> カスタマイズ可能な柔軟なプラン</li>
                            <li><i class="fas fa-check"></i> 業界最安値の料金体系</li>
                            <li><i class="fas fa-check"></i> 導入後の手厚いアフターケア</li>
                        </ul>
                        <a href="#contact" class="lp-btn-primary">詳細を問い合わせる</a>
                    </div>
                    <div class="lp-services-image" data-aos="fade-left">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/services-placeholder.svg" alt="サービスイメージ">
                    </div>
                </div>
            </div>
        </section>

        <!-- 実績セクション -->
        <section id="stats" class="lp-stats-section">
            <div class="lp-container">
                <div class="lp-stats-grid">
                    <div class="lp-stat-item" data-aos="zoom-in" data-aos-delay="100">
                        <div class="lp-stat-number" data-count="1000">0</div>
                        <div class="lp-stat-label">導入企業数</div>
                    </div>
                    <div class="lp-stat-item" data-aos="zoom-in" data-aos-delay="200">
                        <div class="lp-stat-number" data-count="99">0</div>
                        <div class="lp-stat-label">顧客満足度 %</div>
                    </div>
                    <div class="lp-stat-item" data-aos="zoom-in" data-aos-delay="300">
                        <div class="lp-stat-number" data-count="50">0</div>
                        <div class="lp-stat-label">専門スタッフ</div>
                    </div>
                    <div class="lp-stat-item" data-aos="zoom-in" data-aos-delay="400">
                        <div class="lp-stat-number" data-count="10">0</div>
                        <div class="lp-stat-label">運営年数</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- お客様の声セクション -->
        <section id="testimonials" class="lp-testimonials-section">
            <div class="lp-container">
                <h2 class="lp-section-title" data-aos="fade-up">お客様の声</h2>
                <div class="lp-testimonials-grid">
                    <div class="lp-testimonial-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="lp-testimonial-content">
                            <p>"導入後、業務効率が50%向上しました。サポートも手厚く、安心して利用できます。"</p>
                        </div>
                        <div class="lp-testimonial-author">
                            <div class="lp-author-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="lp-author-info">
                                <h4>山田 太郎</h4>
                                <p>株式会社ABC 代表取締役</p>
                            </div>
                        </div>
                    </div>
                    <div class="lp-testimonial-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="lp-testimonial-content">
                            <p>"コストパフォーマンスが非常に高く、中小企業にとって最適なソリューションです。"</p>
                        </div>
                        <div class="lp-testimonial-author">
                            <div class="lp-author-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="lp-author-info">
                                <h4>佐藤 花子</h4>
                                <p>XYZ株式会社 マーケティング部長</p>
                            </div>
                        </div>
                    </div>
                    <div class="lp-testimonial-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="lp-testimonial-content">
                            <p>"迅速な対応と的確なアドバイスで、プロジェクトを成功に導いていただきました。"</p>
                        </div>
                        <div class="lp-testimonial-author">
                            <div class="lp-author-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="lp-author-info">
                                <h4>鈴木 一郎</h4>
                                <p>DEF合同会社 CTO</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTAセクション -->
        <section id="cta" class="lp-cta-section">
            <div class="lp-container">
                <div class="lp-cta-content" data-aos="fade-up">
                    <h2 class="lp-cta-title">今すぐ始めましょう</h2>
                    <p class="lp-cta-description">
                        まずは無料相談から。専門スタッフがあなたのビジネスに最適なプランをご提案します。
                    </p>
                    <a href="#contact" class="lp-btn-cta">無料相談を予約する</a>
                </div>
            </div>
        </section>

        <!-- コンタクトセクション -->
        <section id="contact" class="lp-contact-section">
            <div class="lp-container">
                <h2 class="lp-section-title" data-aos="fade-up">お問い合わせ</h2>
                <div class="lp-contact-wrapper">
                    <div class="lp-contact-info" data-aos="fade-right">
                        <h3>お気軽にご連絡ください</h3>
                        <div class="lp-contact-item">
                            <i class="fas fa-envelope"></i>
                            <p>info@kanucard.com</p>
                        </div>
                        <div class="lp-contact-item">
                            <i class="fas fa-phone"></i>
                            <p>03-1234-5678</p>
                        </div>
                        <div class="lp-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>東京都渋谷区〇〇町1-2-3</p>
                        </div>
                    </div>
                    <div class="lp-contact-form-wrapper" data-aos="fade-left">
                        <form id="lp-contact-form" class="lp-contact-form">
                            <input type="hidden" id="contact_nonce" value="<?php echo wp_create_nonce( 'kanucard_contact_form' ); ?>">
                            <div class="lp-form-group">
                                <label for="name">お名前 <span class="lp-required">*</span></label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="lp-form-group">
                                <label for="email">メールアドレス <span class="lp-required">*</span></label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="lp-form-group">
                                <label for="message">メッセージ <span class="lp-required">*</span></label>
                                <textarea id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="lp-btn-submit">送信する</button>
                        </form>
                        <div id="lp-form-message" class="lp-form-message"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- LPフッター -->
    <footer id="lp-footer" class="lp-site-footer">
        <div class="lp-container">
            <div class="lp-footer-content">
                <div class="lp-footer-branding">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lp-footer-logo">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </div>

                <nav class="lp-footer-navigation">
                    <ul>
                        <li><a href="#features">特徴</a></li>
                        <li><a href="#services">サービス</a></li>
                        <li><a href="#contact">お問い合わせ</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">メインサイト</a></li>
                    </ul>
                </nav>

                <div class="lp-footer-social">
                    <a href="#" class="lp-social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="lp-social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="lp-social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="lp-footer-bottom">
                <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>