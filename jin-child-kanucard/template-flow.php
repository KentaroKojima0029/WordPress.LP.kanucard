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
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>依頼手順 - <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>

    <!-- PSA LP用CSS -->
    <link rel="stylesheet" href="<?php echo $theme_url; ?>/psa-lp/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <style>
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
        }

        .registration-notice {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.05rem;
            color: #0369a1;
            margin-bottom: 1rem;
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
        }

        .registration-image img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .registration-purpose {
            font-size: 0.95rem;
            color: #dc2626;
            margin: 0.5rem 0 1rem;
            font-weight: 500;
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
        }
    </style>
</head>
<body class="flow-page">

    <!-- Header -->
    <header class="flow-page-header">
        <div class="container">
            <h1><i class="fas fa-list-ol"></i> ご依頼の流れ</h1>
            <p>PSA代行サービスのご利用手順をご案内します</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flow-page-content">
        <div class="container">
            <div class="flow-detail-steps">

                <!-- Step 1 -->
                <div class="flow-detail-step" data-aos="fade-up">
                    <div class="flow-detail-number">1</div>
                    <div class="flow-detail-content">
                        <h3><i class="fas fa-user-plus"></i> 会員登録・ログイン</h3>
                        <p>
                            まずは<a href="https://daiko.kanucard.com/login" target="_blank">代行システム</a>にアクセスし、会員登録を行ってください。<br>
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
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flow-detail-step" data-aos="fade-up" data-aos-delay="100">
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
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flow-detail-step" data-aos="fade-up" data-aos-delay="200">
                    <div class="flow-detail-number">3</div>
                    <div class="flow-detail-content">
                        <h3><i class="fas fa-box"></i> カードを発送</h3>
                        <p>
                            フォーム入力完了後、表示される住所宛にカードを発送してください。<br>
                            梱包方法は動画で詳しく解説していますので、初めての方も安心です。
                        </p>
                        <div class="flow-detail-tips">
                            <h4><i class="fas fa-lightbulb"></i> ポイント</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> 追跡番号付きの発送を推奨</li>
                                <li><i class="fas fa-check"></i> カードはスリーブ＋ローダーで保護</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flow-detail-step" data-aos="fade-up" data-aos-delay="300">
                    <div class="flow-detail-number">4</div>
                    <div class="flow-detail-content">
                        <h3><i class="fas fa-microscope"></i> 無料検品・結果確認</h3>
                        <p>
                            カード到着後、プロが無料で検品を行います。<br>
                            検品結果はシステム上でご確認いただき、PSA提出するカードをボタンで簡単に選択できます。
                        </p>
                        <div class="flow-detail-tips">
                            <h4><i class="fas fa-lightbulb"></i> ポイント</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> PSA10が狙えないカードは提出前にお知らせ</li>
                                <li><i class="fas fa-check"></i> 検品結果に納得いかない場合は返送も可能</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="flow-detail-step" data-aos="fade-up" data-aos-delay="400">
                    <div class="flow-detail-number">5</div>
                    <div class="flow-detail-content">
                        <h3><i class="fas fa-plane"></i> 米国PSAへ提出</h3>
                        <p>
                            選択いただいたカードを米国PSA本社へ直接提出します。<br>
                            進捗状況はシステム内メッセージで随時お知らせします。
                        </p>
                        <div class="flow-detail-tips">
                            <h4><i class="fas fa-lightbulb"></i> ポイント</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> 提出前にPSA鑑定料・返送料のお支払い</li>
                                <li><i class="fas fa-check"></i> 処理期間は選択プランにより60〜180日</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Step 6 -->
                <div class="flow-detail-step" data-aos="fade-up" data-aos-delay="500">
                    <div class="flow-detail-number">6</div>
                    <div class="flow-detail-content">
                        <h3><i class="fas fa-gift"></i> 鑑定済みカードをお届け</h3>
                        <p>
                            PSA鑑定が完了したカードを、完璧な梱包で安全にお届けします。<br>
                            70%保証プランで条件を満たした場合は、代行料の一部を返金いたします。
                        </p>
                        <div class="flow-detail-tips">
                            <h4><i class="fas fa-lightbulb"></i> ポイント</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> 配送中の事故にも保険で対応</li>
                                <li><i class="fas fa-check"></i> お届け後もアフターサポート万全</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CTA -->
            <div class="flow-page-cta" data-aos="fade-up">
                <p><i class="fas fa-hand-point-right" style="color: var(--secondary);"></i> さっそく始めてみましょう！</p>
                <a href="https://daiko.kanucard.com/login" class="btn btn-primary btn-large" target="_blank">
                    <i class="fas fa-paper-plane"></i> 今すぐ依頼する
                </a>
                <br>
                <a href="<?php echo home_url('/psa-lp/'); ?>" class="back-to-lp">
                    <i class="fas fa-arrow-left"></i> PSA代行LPに戻る
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="flow-page-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>">株式会社カヌカード</a></p>
        </div>
    </footer>

    <?php wp_footer(); ?>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>
