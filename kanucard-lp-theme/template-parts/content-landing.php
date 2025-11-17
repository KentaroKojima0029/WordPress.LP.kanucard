<?php
/**
 * ランディングページのメインコンテンツ
 *
 * @package Kanucard_LP
 */
?>

<!-- ヒーローセクション -->
<section id="hero" class="hero-section">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1 class="hero-title">
                <?php echo esc_html( get_theme_mod( 'hero_title', 'あなたのビジネスを次のレベルへ' ) ); ?>
            </h1>
            <p class="hero-subtitle">
                <?php echo esc_html( get_theme_mod( 'hero_subtitle', '革新的なソリューションで成功を実現します' ) ); ?>
            </p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url( get_theme_mod( 'cta_button_url', '#contact' ) ); ?>" class="btn-primary">
                    <?php echo esc_html( get_theme_mod( 'cta_button_text', '無料相談' ) ); ?>
                </a>
                <a href="#features" class="btn-secondary">詳しく見る</a>
            </div>
        </div>
    </div>
    <div class="hero-background"></div>
</section>

<!-- 特徴セクション -->
<section id="features" class="features-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">サービスの特徴</h2>
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3 class="feature-title">高速パフォーマンス</h3>
                <p class="feature-description">
                    最先端の技術を活用し、高速で安定したサービスを提供します。あなたのビジネスを加速させます。
                </p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">セキュリティ重視</h3>
                <p class="feature-description">
                    業界最高水準のセキュリティ対策で、お客様のデータを安全に保護します。
                </p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="feature-title">24/7サポート</h3>
                <p class="feature-description">
                    専門チームが24時間365日体制でサポート。いつでも安心してご利用いただけます。
                </p>
            </div>
        </div>
    </div>
</section>

<!-- サービス詳細セクション -->
<section id="services" class="services-section">
    <div class="container">
        <div class="services-content">
            <div class="services-text" data-aos="fade-right">
                <h2 class="section-title">なぜ私たちを選ぶのか</h2>
                <p class="services-description">
                    10年以上の実績と、1000社以上のお客様にご利用いただいています。
                    私たちは単なるサービス提供者ではなく、あなたのビジネスパートナーです。
                </p>
                <ul class="services-list">
                    <li><i class="fas fa-check"></i> 専門家チームによる徹底サポート</li>
                    <li><i class="fas fa-check"></i> カスタマイズ可能な柔軟なプラン</li>
                    <li><i class="fas fa-check"></i> 業界最安値の料金体系</li>
                    <li><i class="fas fa-check"></i> 導入後の手厚いアフターケア</li>
                </ul>
                <a href="#contact" class="btn-primary">詳細を問い合わせる</a>
            </div>
            <div class="services-image" data-aos="fade-left">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/services-placeholder.svg" alt="サービスイメージ">
            </div>
        </div>
    </div>
</section>

<!-- 実績セクション -->
<section id="stats" class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-number" data-count="1000">0</div>
                <div class="stat-label">導入企業数</div>
            </div>
            <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-number" data-count="99">0</div>
                <div class="stat-label">顧客満足度 %</div>
            </div>
            <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-number" data-count="50">0</div>
                <div class="stat-label">専門スタッフ</div>
            </div>
            <div class="stat-item" data-aos="zoom-in" data-aos-delay="400">
                <div class="stat-number" data-count="10">0</div>
                <div class="stat-label">運営年数</div>
            </div>
        </div>
    </div>
</section>

<!-- お客様の声セクション -->
<section id="testimonials" class="testimonials-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">お客様の声</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-content">
                    <p>"導入後、業務効率が50%向上しました。サポートも手厚く、安心して利用できます。"</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="author-info">
                        <h4>山田 太郎</h4>
                        <p>株式会社ABC 代表取締役</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-content">
                    <p>"コストパフォーマンスが非常に高く、中小企業にとって最適なソリューションです。"</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="author-info">
                        <h4>佐藤 花子</h4>
                        <p>XYZ株式会社 マーケティング部長</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-content">
                    <p>"迅速な対応と的確なアドバイスで、プロジェクトを成功に導いていただきました。"</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="author-info">
                        <h4>鈴木 一郎</h4>
                        <p>DEF合同会社 CTO</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTAセクション -->
<section id="cta" class="cta-section">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <h2 class="cta-title">今すぐ始めましょう</h2>
            <p class="cta-description">
                まずは無料相談から。専門スタッフがあなたのビジネスに最適なプランをご提案します。
            </p>
            <a href="#contact" class="btn-cta">無料相談を予約する</a>
        </div>
    </div>
</section>

<!-- コンタクトセクション -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">お問い合わせ</h2>
        <div class="contact-wrapper">
            <div class="contact-info" data-aos="fade-right">
                <h3>お気軽にご連絡ください</h3>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <p>info@kanucard.com</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <p>03-1234-5678</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>東京都渋谷区〇〇町1-2-3</p>
                </div>
            </div>
            <div class="contact-form-wrapper" data-aos="fade-left">
                <form id="contact-form" class="contact-form">
                    <?php wp_nonce_field( 'kanucard_contact_form', 'contact_nonce' ); ?>
                    <div class="form-group">
                        <label for="name">お名前 <span class="required">*</span></label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">メッセージ <span class="required">*</span></label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">送信する</button>
                </form>
                <div id="form-message" class="form-message"></div>
            </div>
        </div>
    </div>
</section>