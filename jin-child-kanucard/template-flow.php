<?php
/**
 * Template Name: 依頼手順ページ
 * Template Post Type: page
 *
 * PSA代行サービス依頼手順専用ページテンプレート
 *
 * @package JIN_Child_Kanucard
 */

// アセットのベースURL
$theme_url = get_stylesheet_directory_uri();

get_header();
?>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
            --primary: #3b4675;
            --primary-dark: #2d3659;
            --secondary: #c4a000;
            --text: #333;
            --text-secondary: #666;
            --bg-white: #fff;
        }
    </style>

    <style>
        /* JINスムーズスクロール無効化 */
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

        /* 固定ヘッダー分の余白を #scroll-content に設定（ピックアップコンテンツ含め押し下げ） */
        #scroll-content {
            padding-top: 70px; /* JS で実際のヘッダー高さに上書き */
        }

        /* JINヘッダーを固定表示 */
        #header-box {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }

        /* ハンバーガーメニューもヘッダーと同じ位置に固定 */
        .sp-menu-open,
        #navtoggle,
        #navtoggle + .sp-menu-open,
        label.sp-menu-open {
            position: fixed !important;
            z-index: 99999 !important;
            top: 0 !important;
        }

        .admin-bar .sp-menu-open,
        .admin-bar #navtoggle,
        .admin-bar #navtoggle + .sp-menu-open,
        .admin-bar label.sp-menu-open {
            top: 32px !important;
        }

        @media (max-width: 782px) {
            .admin-bar .sp-menu-open,
            .admin-bar #navtoggle,
            .admin-bar #navtoggle + .sp-menu-open,
            .admin-bar label.sp-menu-open {
                top: 46px !important;
            }
        }

        /* 管理バー表示時はその分ずらす */
        .admin-bar #header-box {
            top: 32px;
        }

        @media (max-width: 782px) {
            .admin-bar #header-box {
                top: 46px;
            }
        }

        html, body.flow-page {
            overflow-y: auto !important;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .flow-page * {
            touch-action: pan-y;
        }

        .flow-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .flow-page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 3rem 0;
            text-align: center;
            color: #fff;
        }

        .flow-page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .flow-page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .flow-page-content {
            padding: 4rem 0;
        }

        .flow-detail-steps {
            max-width: 900px;
            margin: 0 auto;
        }

        .flow-detail-step {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            position: relative;
        }

        .flow-detail-step:not(:last-child)::after {
            content: '';
            position: absolute;
            bottom: -2rem;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 2rem;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .flow-detail-number {
            width: 70px;
            height: 70px;
            min-width: 70px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            box-shadow: 0 8px 25px rgba(59, 70, 117, 0.3);
        }

        .flow-detail-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .flow-detail-content h3 i {
            color: var(--secondary);
            margin-right: 0.5rem;
        }

        .flow-detail-content p {
            font-size: 1.05rem;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .flow-detail-tips {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-top: 1rem;
        }

        .flow-detail-tips h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 0.5rem;
        }

        .flow-detail-tips h4 i {
            margin-right: 0.5rem;
        }

        .flow-detail-tips ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .flow-detail-tips ul li {
            font-size: 0.9rem;
            color: #78350f;
            padding: 0.25rem 0;
        }

        .flow-detail-tips ul li i {
            color: #d97706;
            margin-right: 0.5rem;
        }

        .flow-page-cta {
            text-align: center;
            padding: 3rem 0 4rem;
        }

        .flow-page-cta p {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 1.5rem;
        }

        .flow-page-cta .btn {
            font-size: 1.2rem;
            padding: 1rem 3rem;
        }

        .flow-page-footer {
            background: var(--primary-dark);
            color: #fff;
            text-align: center;
            padding: 2rem;
        }

        .flow-page-footer a {
            color: var(--secondary);
            text-decoration: none;
        }

        .back-to-lp {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.95rem;
            margin-top: 1rem;
            transition: color 0.3s ease;
        }

        .back-to-lp:hover {
            color: #fff;
        }

        /* 新規登録案内スタイル */
        .registration-guide {
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            border: 2px solid #0ea5e9;
            border-radius: 12px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            touch-action: pan-y;
        }

        .registration-notice {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.05rem;
            color: #0369a1;
            margin-bottom: 1rem;
            touch-action: pan-y;
        }

        .registration-notice i {
            font-size: 1.3rem;
            color: #0ea5e9;
        }

        .highlight-btn {
            background: #f59e0b;
            color: #fff;
            padding: 2px 10px;
            border-radius: 6px;
            font-weight: 700;
        }

        .registration-image {
            text-align: center;
            touch-action: pan-y;
        }

        .registration-image img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            touch-action: pan-y;
            pointer-events: none;
        }

        .registration-purpose {
            font-size: 0.95rem;
            color: #dc2626;
            margin: 0.5rem 0 1rem;
            font-weight: 500;
        }

        /* ボタンスタイル */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 70, 117, 0.3);
        }

        .btn-large {
            font-size: 1.1rem;
            padding: 1rem 2.5rem;
        }

        .step-link {
            margin-top: 1.5rem;
            width: 100%;
            color: #fff !important;
        }

        .step-link:hover {
            color: #fff !important;
        }

        .flow-detail-tips-global {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 16px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .flow-detail-tips-global h4 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 1rem;
        }

        .flow-detail-tips-global h4 i {
            margin-right: 0.5rem;
        }

        .flow-detail-tips-global ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .flow-detail-tips-global ul li {
            font-size: 1.05rem;
            color: #78350f;
            padding: 0.5rem 0;
        }

        .flow-detail-tips-global ul li i {
            color: #d97706;
            margin-right: 0.5rem;
        }

        /* 代行サイトでできること */
        .feature-section {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            margin-top: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
        }

        .feature-list li {
            font-size: 1.05rem;
            color: var(--text);
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-number {
            color: var(--secondary);
            font-weight: 700;
            margin-right: 0.5rem;
        }

        .feature-image {
            text-align: center;
            margin-top: 1.5rem;
        }

        .feature-image img {
            max-width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        /* 画面下部固定ボタンバー */
        .fixed-bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
            padding: 12px 20px;
            display: flex;
            gap: 12px;
            justify-content: center;
            z-index: 9999;
        }

        .fixed-bottom-bar .btn-fixed {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            flex: 1;
            max-width: 280px;
        }

        .btn-register {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.5);
            color: #fff !important;
        }

        .btn-daiko {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(59, 70, 117, 0.4);
        }

        .btn-daiko:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 70, 117, 0.5);
            color: #fff !important;
        }

        /* 固定バーの高さ分だけ下部に余白 */
        .flow-page {
            padding-bottom: 80px;
        }

        @media (max-width: 768px) {
            .flow-page-header h1 {
                font-size: 1.8rem;
            }

            .registration-notice {
                flex-direction: column;
                text-align: center;
            }

            .flow-detail-step {
                flex-direction: column;
                padding: 1.5rem;
                text-align: center;
            }

            .flow-detail-number {
                margin: 0 auto 1rem;
            }

            .flow-detail-content h3 {
                font-size: 1.3rem;
            }

            .fixed-bottom-bar {
                padding: 10px 12px;
                gap: 8px;
            }

            .fixed-bottom-bar .btn-fixed {
                padding: 10px 12px;
                font-size: 0.8rem;
            }
        }
    </style>

<div class="flow-page">

    <!-- Header -->
    <header class="flow-page-header">
        <div class="container">
            <h1>ご登録手順</h1>
            <p>PSA代行サービスのご利用手順をご案内します</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flow-page-content">
        <div class="container">
            <div class="flow-detail-steps">

                <!-- Step 1 -->
                <div class="flow-detail-step">
                    <div class="flow-detail-number">1</div>
                    <div class="flow-detail-content">
                        <h3><i class="fas fa-user-plus"></i> 会員登録・ログイン</h3>
                        <p>
                            まずは決済システムにアクセスし、会員登録を行ってください。<br>
                            メールアドレスとパスワードを設定するだけで、すぐにご利用いただけます。
                        </p>

                        <!-- 新規登録の案内 -->
                        <div class="registration-guide">
                            <div class="registration-notice">
                                <i class="fas fa-hand-point-right"></i>
                                <span><strong>初めてご利用の方</strong>は、下記画像内の<span class="highlight-btn">「アカウントを作成する」</span>ボタンから新規登録してください。</span>
                            </div>
                            <p class="registration-purpose">※決済システム連携の目的で登録が必要です。</p>
                            <div class="registration-image">
                                <img src="https://kanucard.com/wp-content/uploads/2026/02/IMG_1740-1.jpg" alt="新規登録画面">
                            </div>
                            <a href="https://shop.kanucard.com/account/login" class="btn btn-primary btn-large step-link" target="_blank">
                                1つ目の登録へ進む
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flow-detail-step">
                    <div class="flow-detail-number">2</div>
                    <div class="flow-detail-content">
                        <h3><i class="fas fa-cog"></i> 代行サイトの初期設定</h3>
                        <p>
                            新代行サイトを利用するための設定が必要です。
                        </p>

                        <!-- 初期設定の案内 -->
                        <div class="registration-guide">
                            <div class="registration-notice">
                                <i class="fas fa-hand-point-right"></i>
                                <span>下記画像内の<span class="highlight-btn">「新規登録はこちら」</span>から登録してください。</span>
                            </div>
                            <div class="registration-image">
                                <img src="https://kanucard.com/wp-content/uploads/2026/02/IMG_1742.jpeg" alt="代行サイト初期設定画面">
                            </div>
                            <a href="https://daiko.kanucard.com/login" class="btn btn-primary btn-large step-link" target="_blank">
                                代行サイトへ進む
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ポイント -->
                <div class="flow-detail-tips-global">
                    <h4><i class="fas fa-lightbulb"></i> ポイント</h4>
                    <ul>
                        <li><i class="fas fa-check"></i> 各サイトのパスワードは同じでも構いません。</li>
                        <li><i class="fas fa-check"></i> 名前・住所等のお客様情報は1つ目のサイトで変更してください。</li>
                    </ul>
                </div>

                <!-- 代行サイトでできること -->
                <div class="feature-section">
                    <h3 class="feature-title">代行サイトでできること</h3>
                    <ul class="feature-list">
                        <li><span class="feature-number">①</span>ホームへ戻る</li>
                        <li><span class="feature-number">②</span>メニューボタン　各ページに移動できます。</li>
                        <li><span class="feature-number">③</span>発送スケジュール　次回発送日が確認できます。</li>
                        <li><span class="feature-number">④</span>目的ボタン　任意のページに移動できます。</li>
                        <li><span class="feature-number">⑤</span>利用状況確認　お取引が完了したPSA10取得率を確認できます。</li>
                    </ul>
                    <div class="feature-image">
                        <img src="https://kanucard.com/wp-content/uploads/2026/02/IMG_1744-scaled.jpeg" alt="代行サイトでできること">
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- 画面下部固定ボタンバー -->
    <div class="fixed-bottom-bar">
        <a href="https://shop.kanucard.com/account/login" class="btn-fixed btn-register" target="_blank">
            1つ目の登録へ
        </a>
        <a href="https://daiko.kanucard.com/login" class="btn-fixed btn-daiko" target="_blank">
            代行サイトへ
        </a>
    </div>

    <!-- Footer -->
    <footer class="flow-page-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>">株式会社カヌカード</a></p>
        </div>
    </footer>

</div><!-- .flow-page -->

<script>
// JINスムーズスクロール無効化
// wheelイベントのキャプチャでJINのリスナーを迂回
window.addEventListener('wheel', function(e) {
    e.stopImmediatePropagation();
}, true);

window.addEventListener('load', function() {
    var sc = document.getElementById('scroll-content');
    if (sc) {
        sc.classList.remove('animate');
        sc.style.setProperty('transform', 'none', 'important');
        // overflow-y:scrollだとfixed要素の基準が変わるため、visibleに変更
        sc.style.setProperty('overflow', 'visible', 'important');
        sc.style.setProperty('position', 'static', 'important');
        sc.style.setProperty('height', 'auto', 'important');
    }
    // html/bodyでネイティブスクロール
    document.documentElement.style.setProperty('overflow-y', 'auto', 'important');
    document.body.style.setProperty('overflow-y', 'auto', 'important');

    // 固定ヘッダーの実際の高さに合わせて padding-top を動的に設定
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
