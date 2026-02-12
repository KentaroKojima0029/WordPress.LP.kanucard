<?php
/**
 * Template Name: 友達紹介キャンペーン
 * Template Post Type: page, post
 *
 * 友達紹介キャンペーンページテンプレート
 *
 * @package JIN_Child_Kanucard
 */

get_header();
?>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --rc-primary: #1A1A1A;
        --rc-primary-dark: #0D0D0D;
        --rc-secondary: #2A2A2A;
        --rc-accent: #C9A84C;
        --rc-accent-dark: #A88A3A;
        --rc-gold-light: #E8D48B;
        --rc-text: #1A1A1A;
        --rc-text-light: #555555;
        --rc-bg: #F5F3EE;
        --rc-white: #FFFFFF;
        --rc-success: #10B981;
        --rc-error: #EF4444;
        --rc-warning-bg: #FFFBEB;
        --rc-warning-border: #FDE68A;
    }

    /* JIN  */
    #scroll-content,
    #scroll-content.animate {
        transform: none !important;
        -webkit-transform: none !important;
        will-change: auto !important;
        transition: none !important;
        animation: none !important;
        overflow: visible !important;
        position: static !important;
        height: auto !important;
    }

    /*  #scroll-content  */
    #scroll-content {
        padding-top: 70px;
    }

    /* JIN */
    #header-box {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        z-index: 9999;
    }

    /*  */
    .sp-menu-open,
    #navtoggle,
    #navtoggle + .sp-menu-open,
    label.sp-menu-open {
        position: fixed !important;
        z-index: 99999 !important;
        top: 0 !important;
    }

    .admin-bar #header-box {
        top: 32px;
    }

    .admin-bar .sp-menu-open,
    .admin-bar #navtoggle,
    .admin-bar #navtoggle + .sp-menu-open,
    .admin-bar label.sp-menu-open {
        top: 32px !important;
    }

    @media (max-width: 782px) {
        .admin-bar #header-box {
            top: 46px;
        }
        .admin-bar .sp-menu-open,
        .admin-bar #navtoggle,
        .admin-bar #navtoggle + .sp-menu-open,
        .admin-bar label.sp-menu-open {
            top: 46px !important;
        }
    }

    html, body {
        overflow-y: auto !important;
        overflow-x: hidden;
    }

    /* ==================== */
    /*  Base                */
    /* ==================== */
    .rc-page {
        font-family: 'Noto Sans JP', -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--rc-text);
        line-height: 1.8;
        overflow-x: hidden;
    }

    .rc-page *,
    .rc-page *::before,
    .rc-page *::after {
        box-sizing: border-box;
    }

    .rc-page h1,
    .rc-page h2,
    .rc-page h3,
    .rc-page h4 {
        border: none;
        background: none;
        padding: 0;
        margin: 0;
    }

    .rc-page ul {
        padding-left: 0;
        list-style: none;
    }

    .rc-page ul li::before {
        display: none;
    }

    .rc-page a {
        text-decoration: none;
    }

    .rc-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* ==================== */
    /*  Hero                */
    /* ==================== */
    .rc-hero {
        background: linear-gradient(135deg, #0D0D0D 0%, #1A1A1A 40%, #2A2A2A 100%);
        padding: 80px 0 70px;
        text-align: center;
        color: var(--rc-white);
        position: relative;
        overflow: hidden;
    }

    .rc-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, rgba(201,168,76,0.12) 0%, transparent 50%),
                    radial-gradient(circle at 70% 60%, rgba(201,168,76,0.08) 0%, transparent 40%);
        pointer-events: none;
    }

    .rc-hero-inner {
        position: relative;
        z-index: 1;
    }

    .rc-hero-badge {
        display: inline-block;
        background: var(--rc-accent);
        color: var(--rc-white);
        padding: 6px 24px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .rc-hero h1 {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 20px;
        letter-spacing: 1px;
        line-height: 1.4;
    }

    .rc-hero-discount {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .rc-hero-discount .rc-highlight {
        background: linear-gradient(135deg, var(--rc-accent), var(--rc-gold-light));
        color: var(--rc-primary-dark);
        padding: 2px 12px;
        border-radius: 6px;
        font-size: 26px;
        font-weight: 800;
    }

    .rc-hero-period {
        font-size: 15px;
        opacity: 0.9;
        margin-bottom: 32px;
        line-height: 1.6;
    }

    .rc-hero-period i {
        margin-right: 6px;
    }

    .rc-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 16px 48px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .rc-btn-accent {
        background: linear-gradient(135deg, var(--rc-accent), var(--rc-gold-light));
        color: var(--rc-primary-dark);
        box-shadow: 0 4px 15px rgba(201, 168, 76, 0.4);
        font-weight: 800;
    }

    .rc-btn-accent:hover {
        background: linear-gradient(135deg, var(--rc-accent-dark), var(--rc-accent));
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(201, 168, 76, 0.5);
        color: var(--rc-primary-dark);
    }

    .rc-btn-primary {
        background: var(--rc-primary);
        color: var(--rc-accent);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(201, 168, 76, 0.3);
    }

    .rc-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        color: var(--rc-accent);
    }

    /* ==================== */
    /*  Sections common     */
    /* ==================== */
    .rc-section {
        padding: 70px 0;
    }

    .rc-section-alt {
        background: var(--rc-bg);
    }

    .rc-section-title {
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        color: var(--rc-primary);
        margin-bottom: 40px;
    }

    .rc-section-title .rc-title-en {
        display: block;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 3px;
        color: var(--rc-accent);
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    /* ==================== */
    /*  Overview            */
    /* ==================== */
    .rc-overview-text {
        text-align: center;
        font-size: 16px;
        color: var(--rc-text);
        margin-bottom: 36px;
        line-height: 2;
    }

    .rc-overview-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .rc-overview-card {
        background: var(--rc-white);
        border-radius: 16px;
        padding: 28px 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        text-align: center;
    }

    .rc-overview-card-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--rc-primary), var(--rc-primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .rc-overview-card-icon i {
        font-size: 22px;
        color: var(--rc-white);
    }

    .rc-overview-card h3 {
        font-size: 15px;
        font-weight: 700;
        color: var(--rc-primary);
        margin-bottom: 10px;
    }

    .rc-overview-card p {
        font-size: 14px;
        color: var(--rc-text-light);
        line-height: 1.7;
    }

    /* ==================== */
    /*  Steps               */
    /* ==================== */
    .rc-steps {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .rc-step {
        background: var(--rc-white);
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        display: flex;
        gap: 24px;
        align-items: flex-start;
        position: relative;
        margin-bottom: 24px;
    }

    .rc-step:not(:last-child)::after {
        content: '';
        position: absolute;
        bottom: -24px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 24px;
        background: linear-gradient(180deg, var(--rc-primary), var(--rc-accent));
        border-radius: 2px;
    }

    .rc-step-number {
        width: 64px;
        height: 64px;
        min-width: 64px;
        background: linear-gradient(135deg, var(--rc-primary), var(--rc-primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 800;
        color: var(--rc-accent);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    }

    .rc-step-content h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--rc-text);
        margin-bottom: 12px;
    }

    .rc-step-content h3 i {
        color: var(--rc-accent);
        margin-right: 8px;
    }

    .rc-step-content p {
        font-size: 15px;
        color: var(--rc-text-light);
        line-height: 1.9;
    }

    .rc-step-image {
        margin-top: 16px;
        text-align: center;
    }

    .rc-step-image img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .rc-step-warning {
        background: var(--rc-warning-bg);
        border: 1px solid var(--rc-warning-border);
        border-radius: 10px;
        padding: 14px 18px;
        margin-top: 14px;
        font-size: 14px;
        color: #92400e;
        line-height: 1.7;
    }

    .rc-step-warning i {
        color: var(--rc-accent-dark);
        margin-right: 6px;
    }

    /* Point box */
    .rc-step-point {
        background: linear-gradient(135deg, #FFFBEB, #FEF3C7);
        border: 2px solid var(--rc-accent);
        border-radius: 20px;
        padding: 28px 32px;
        display: flex;
        gap: 20px;
        align-items: flex-start;
        margin-top: 12px;
    }

    .rc-step-point-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        background: var(--rc-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: var(--rc-white);
    }

    .rc-step-point-content h3 {
        font-size: 18px;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 10px;
    }

    .rc-step-point-content p {
        font-size: 15px;
        color: #78350f;
        line-height: 1.8;
        margin-bottom: 16px;
    }

    .rc-btn-sm {
        padding: 10px 28px;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .rc-step-point {
            flex-direction: column;
            padding: 20px;
            text-align: center;
        }

        .rc-step-point-icon {
            margin: 0 auto;
        }
    }

    /* ==================== */
    /*  Notes               */
    /* ==================== */
    .rc-notes {
        background: #FEF2F2;
        border-radius: 16px;
        padding: 36px;
    }

    .rc-notes h3 {
        font-size: 18px;
        font-weight: 700;
        color: var(--rc-error);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rc-notes ul {
        margin: 0;
    }

    .rc-notes ul li {
        font-size: 14px;
        color: var(--rc-text);
        padding: 8px 0;
        padding-left: 20px;
        position: relative;
        line-height: 1.7;
        border-bottom: 1px solid rgba(239, 68, 68, 0.1);
    }

    .rc-notes ul li:last-child {
        border-bottom: none;
    }

    .rc-notes ul li::before {
        content: '';
        display: block !important;
        position: absolute;
        left: 0;
        top: 16px;
        width: 6px;
        height: 6px;
        background: var(--rc-error);
        border-radius: 50%;
    }

    /* ==================== */
    /*  FAQ                 */
    /* ==================== */
    .rc-faq-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .rc-faq-item {
        background: var(--rc-white);
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid var(--rc-bg);
    }

    .rc-faq-item summary {
        padding: 20px 24px;
        font-size: 15px;
        font-weight: 700;
        color: var(--rc-text);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        list-style: none;
        transition: background 0.2s ease;
    }

    .rc-faq-item summary::-webkit-details-marker {
        display: none;
    }

    .rc-faq-item summary::before {
        content: 'Q.';
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        min-width: 32px;
        background: var(--rc-primary);
        color: var(--rc-white);
        border-radius: 50%;
        font-size: 13px;
        font-weight: 800;
    }

    .rc-faq-item summary::after {
        content: '\f078';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 12px;
        color: var(--rc-text-light);
        margin-left: auto;
        transition: transform 0.3s ease;
    }

    .rc-faq-item[open] summary::after {
        transform: rotate(180deg);
    }

    .rc-faq-item[open] summary {
        background: var(--rc-bg);
    }

    .rc-faq-answer {
        padding: 0 24px 20px;
        padding-left: 68px;
        font-size: 15px;
        color: var(--rc-text-light);
        line-height: 1.8;
    }

    .rc-faq-answer::before {
        content: 'A.';
        font-weight: 800;
        color: var(--rc-accent);
        margin-right: 6px;
    }

    /* ==================== */
    /*  CTA Bottom          */
    /* ==================== */
    .rc-cta-bottom {
        background: linear-gradient(135deg, #0D0D0D 0%, #1A1A1A 100%);
        padding: 60px 0;
        text-align: center;
        color: var(--rc-white);
    }

    .rc-cta-bottom p {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 24px;
    }

    .rc-cta-bottom .rc-btn {
        font-size: 18px;
        padding: 18px 56px;
    }

    /* ==================== */
    /*  Footer              */
    /* ==================== */
    .rc-footer {
        background: #111827;
        color: rgba(255, 255, 255, 0.7);
        text-align: center;
        padding: 24px;
        font-size: 13px;
    }

    .rc-footer a {
        color: var(--rc-accent);
    }

    /* ==================== */
    /*  Responsive          */
    /* ==================== */
    @media (max-width: 768px) {
        .rc-hero {
            padding: 60px 0 50px;
        }

        .rc-hero h1 {
            font-size: 24px;
        }

        .rc-hero-discount {
            font-size: 18px;
        }

        .rc-hero-discount .rc-highlight {
            font-size: 22px;
        }

        .rc-btn {
            padding: 14px 32px;
            font-size: 15px;
        }

        .rc-section {
            padding: 50px 0;
        }

        .rc-section-title {
            font-size: 22px;
            margin-bottom: 28px;
        }

        .rc-overview-cards {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .rc-step {
            flex-direction: column;
            padding: 24px;
            text-align: center;
        }

        .rc-step-number {
            margin: 0 auto;
        }

        .rc-step-content h3 {
            font-size: 18px;
        }

        .rc-notes {
            padding: 24px;
        }

        .rc-faq-item summary {
            padding: 16px 18px;
            font-size: 14px;
        }

        .rc-faq-answer {
            padding-left: 18px;
            font-size: 14px;
        }

        .rc-cta-bottom p {
            font-size: 17px;
        }

        .rc-cta-bottom .rc-btn {
            font-size: 16px;
            padding: 16px 40px;
            width: 100%;
            max-width: 360px;
        }
    }

    /* ==================== */
    /*  Eyecatch            */
    /* ==================== */
    .rc-eyecatch {
        width: 100%;
        overflow: hidden;
        background: var(--rc-primary-dark);
        line-height: 0;
    }

    .rc-eyecatch img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    /* JIN theme overrides */
    .rc-page .cps-post-main {
        padding: 0 !important;
    }
</style>

<div class="rc-page">

    <!-- ==================== -->
    <!-- Eyecatch             -->
    <!-- ==================== -->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="rc-eyecatch">
        <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
    </div>
    <?php endif; ?>

    <!-- ==================== -->
    <!-- Hero                 -->
    <!-- ==================== -->
    <section class="rc-hero">
        <div class="rc-container rc-hero-inner">
            <span class="rc-hero-badge"><i class="fas fa-gift"></i> 期間限定</span>
            <h1>友達紹介キャンペーン</h1>
            <p class="rc-hero-discount">
                紹介した方も、された方も、代行料 <span class="rc-highlight">30%OFF</span>
            </p>
            <p class="rc-hero-period">
                <i class="fas fa-calendar-alt"></i>
                キャンペーン期間：2026年2月1日（日）〜 3月31日（火）
            </p>
            <a href="https://daiko.kanucard.com/login" class="rc-btn rc-btn-accent" target="_blank">
                今すぐ申し込む <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- ==================== -->
    <!-- Overview             -->
    <!-- ==================== -->
    <section class="rc-section">
        <div class="rc-container">
            <h2 class="rc-section-title">
                <span class="rc-title-en">Campaign</span>
                キャンペーン概要
            </h2>
            <p class="rc-overview-text">
                PSA代行サービスをご利用いただいたお客様からのご紹介で、<br>
                紹介者・被紹介者の双方に<strong>代行料30%OFFクーポン</strong>をプレゼントします。
            </p>
            <div class="rc-overview-cards">
                <div class="rc-overview-card">
                    <div class="rc-overview-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>対象</h3>
                    <p>当サービスをご利用済みのお客様（紹介者）と、ご紹介を受けて新規にお申込みいただくお客様（被紹介者）</p>
                </div>
                <div class="rc-overview-card">
                    <div class="rc-overview-card-icon">
                        <i class="fas fa-percent"></i>
                    </div>
                    <h3>割引対象</h3>
                    <p>代行手数料のみ<br>（送料・PSA鑑定料・保険料等は対象外）</p>
                </div>
                <div class="rc-overview-card">
                    <div class="rc-overview-card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>キャンペーン期間</h3>
                    <p>2026年2月1日（日）<br>〜 2026年3月31日（火）</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== -->
    <!-- Steps                -->
    <!-- ==================== -->
    <section class="rc-section rc-section-alt">
        <div class="rc-container">
            <h2 class="rc-section-title">
                <span class="rc-title-en">How to Use</span>
                ご利用の流れ
            </h2>
            <div class="rc-steps">

                <!-- Step 1 -->
                <div class="rc-step">
                    <div class="rc-step-number">1</div>
                    <div class="rc-step-content">
                        <h3><i class="fas fa-file-alt"></i> 新代行サイトから申込み</h3>
                        <p>
                            新代行サイトよりお申込みください。<br>
                            お申込みフォームの「メッセージ欄」に、<strong>紹介者の漢字フルネーム</strong>をご記入ください。
                        </p>
                        <div class="rc-step-image">
                            <img src="https://kanucard.com/wp-content/uploads/2026/02/IMG_1779.png" alt="申込みフォームのメッセージ欄に紹介者名を記入">
                        </div>
                        <div class="rc-step-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>注意：</strong>ニックネームや略称は不可です。必ず漢字のフルネームをご記入ください。<br>
                            紹介者のお名前の記載がない場合、キャンペーン適用外となります。
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="rc-step">
                    <div class="rc-step-number">2</div>
                    <div class="rc-step-content">
                        <h3><i class="fas fa-ticket-alt"></i> 割引コードをお届け</h3>
                        <p>
                            キャンペーン終了後、約1ヶ月以内を目処に<br>
                            ご登録のメールアドレスへ<strong>30%OFF割引コード</strong>をお送りします。<br>
                            次回のお申込み時にご利用いただけます。
                        </p>
                    </div>
                </div>

                <!-- ポイント -->
                <div class="rc-step-point">
                    <div class="rc-step-point-icon"><i class="fas fa-lightbulb"></i></div>
                    <div class="rc-step-point-content">
                        <h3>ポイント：口コミを投稿しよう！</h3>
                        <p>
                            サービスご利用後、ぜひ口コミの投稿にご協力ください。<br>
                            下記リンクの「アクセスボタン」→「口コミを送信」から投稿できます。
                        </p>
                        <a href="https://kanucard.com/psa-lp/" class="rc-btn rc-btn-accent rc-btn-sm" target="_blank">
                            口コミを投稿する <i class="fas fa-arrow-right"></i>
                        </a>
                        <!-- 後日画像を追加予定 -->
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==================== -->
    <!-- Notes                -->
    <!-- ==================== -->
    <section class="rc-section">
        <div class="rc-container">
            <h2 class="rc-section-title">
                <span class="rc-title-en">Notice</span>
                ご注意事項
            </h2>
            <div class="rc-notes">
                <h3><i class="fas fa-exclamation-circle"></i> 必ずお読みください</h3>
                <ul>
                    <li>割引対象は代行手数料のみです。送料・PSA鑑定料・保険料等には適用されません。</li>
                    <li>割引コードはお1人様1回限り有効です。</li>
                    <li>割引コードの使用期限はコード送付時にメールでご案内します。期限を過ぎたコードはご利用いただけません。</li>
                    <li>他のキャンペーン・クーポンとの併用はできません。</li>
                    <li>メッセージ欄に紹介者の漢字フルネームの記載がない場合、キャンペーン適用外となりますのでご注意ください。</li>
                    <li>口コミの投稿にもぜひご協力ください（任意）。</li>
                    <li>キャンペーン内容は予告なく変更・終了する場合があります。</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ==================== -->
    <!-- FAQ                  -->
    <!-- ==================== -->
    <section class="rc-section rc-section-alt">
        <div class="rc-container">
            <h2 class="rc-section-title">
                <span class="rc-title-en">FAQ</span>
                よくあるご質問
            </h2>
            <div class="rc-faq-list">

                <details class="rc-faq-item">
                    <summary>紹介された側は初回の申込みから割引が使えますか？</summary>
                    <div class="rc-faq-answer">初回のお申込みではご利用いただけません。割引コードは次回以降のご利用時に適用となります。</div>
                </details>

                <details class="rc-faq-item">
                    <summary>何人まで紹介できますか？</summary>
                    <div class="rc-faq-answer">紹介人数に上限はありません。ただし割引コードはお1人様1回限りの使用となります。</div>
                </details>

                <details class="rc-faq-item">
                    <summary>家族や同居人も紹介対象になりますか？</summary>
                    <div class="rc-faq-answer">はい、別々のアカウントでお申込みいただければ対象です。</div>
                </details>

                <details class="rc-faq-item">
                    <summary>割引コードはいつ届きますか？</summary>
                    <div class="rc-faq-answer">キャンペーン終了後（2026年3月末以降）、約1ヶ月以内にメールでお届けします。</div>
                </details>

                <details class="rc-faq-item">
                    <summary>口コミはどこに投稿すればいいですか？</summary>
                    <div class="rc-faq-answer"><a href="https://kanucard.com/psa-lp/" target="_blank" style="color: var(--rc-accent); text-decoration: underline;">PSA代行ページ</a>の「アクセスボタン」→「口コミを送信」から投稿できます。</div>
                </details>

                <details class="rc-faq-item">
                    <summary>メッセージ欄に紹介者の名前を書き忘れました。後から申告できますか？</summary>
                    <div class="rc-faq-answer">お早めに弊社までお問い合わせください。状況に応じて対応いたします。</div>
                </details>

                <details class="rc-faq-item">
                    <summary>他のクーポンと併用できますか？</summary>
                    <div class="rc-faq-answer">他のキャンペーンやクーポンとの併用はできません。</div>
                </details>

            </div>
        </div>
    </section>

    <!-- ==================== -->
    <!-- CTA Bottom           -->
    <!-- ==================== -->
    <section class="rc-cta-bottom">
        <div class="rc-container">
            <p>友達を紹介して、おトクにPSA代行を利用しよう！</p>
            <a href="https://daiko.kanucard.com/login" class="rc-btn rc-btn-accent" target="_blank">
                今すぐ代行サイトから申し込む <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="rc-footer">
        <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>">株式会社カヌカード</a></p>
    </footer>

</div><!-- .rc-page -->

<script>
// JIN
window.addEventListener('wheel', function(e) {
    e.stopImmediatePropagation();
}, true);

window.addEventListener('load', function() {
    var sc = document.getElementById('scroll-content');
    if (sc) {
        sc.classList.remove('animate');
        sc.style.setProperty('transform', 'none', 'important');
        sc.style.setProperty('overflow', 'visible', 'important');
        sc.style.setProperty('position', 'static', 'important');
        sc.style.setProperty('height', 'auto', 'important');
    }
    document.documentElement.style.setProperty('overflow-y', 'auto', 'important');
    document.body.style.setProperty('overflow-y', 'auto', 'important');

    //  padding-top
    function adjustPaddingForHeader() {
        var header = document.getElementById('header-box');
        if (header && sc) {
            var headerHeight = header.offsetHeight;
            sc.style.paddingTop = headerHeight + 'px';
        }
    }
    adjustPaddingForHeader();
    window.addEventListener('resize', adjustPaddingForHeader);
});
</script>

<?php get_footer(); ?>
