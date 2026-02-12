<?php
/**
 * Template Name: 業務委託募集ページ
 * Template Post Type: page
 *
 * 業務委託パートナー募集用のランディングページテンプレート
 *
 * @package JIN_Child_Kanucard
 */

// フォーム送信処理
$form_submitted = false;
$form_error = '';

if ( isset( $_POST['submit_recruitment'] ) && isset( $_POST['recruitment_nonce'] ) ) {
    if ( wp_verify_nonce( $_POST['recruitment_nonce'], 'recruitment_form' ) ) {
        $name = sanitize_text_field( $_POST['applicant_name'] );
        $email = sanitize_email( $_POST['applicant_email'] );
        $phone = sanitize_text_field( $_POST['applicant_phone'] );
        $message = sanitize_textarea_field( $_POST['applicant_message'] );

        if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
            $form_error = '必須項目を入力してください。';
        } else {
            // データベースに保存
            $applications = get_option( 'recruitment_applications', array() );
            $new_application = array(
                'id' => uniqid(),
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'message' => $message,
                'date' => current_time( 'Y-m-d H:i:s' ),
                'read' => false
            );
            $applications[] = $new_application;
            update_option( 'recruitment_applications', $applications );

            // 管理者にメール通知
            $admin_email = get_option( 'admin_email' );
            $subject = '【業務委託応募】' . $name . '様からの応募がありました';
            $email_body = "業務委託の応募がありました。\n\n";
            $email_body .= "【お名前】\n{$name}\n\n";
            $email_body .= "【メールアドレス】\n{$email}\n\n";
            $email_body .= "【電話番号】\n{$phone}\n\n";
            $email_body .= "【志望動機・メッセージ】\n{$message}\n\n";
            $email_body .= "---\n";
            $email_body .= "管理画面から確認: " . admin_url( 'admin.php?page=recruitment-applications' );

            $headers = array( 'Content-Type: text/plain; charset=UTF-8' );
            wp_mail( $admin_email, $subject, $email_body, $headers );

            // リダイレクト
            wp_safe_redirect( add_query_arg( 'submitted', '1', get_permalink() ) );
            exit;
        }
    } else {
        $form_error = 'セキュリティエラーが発生しました。もう一度お試しください。';
    }
}

$is_submitted = isset( $_GET['submitted'] ) && $_GET['submitted'] === '1';

get_header();
?>

<div class="recruitment-page">
    <!-- Hero Section -->
    <section class="recruitment-hero">
        <div class="recruitment-container">
            <div class="hero-content" data-aos="fade-up">
                <span class="hero-badge">Partner Wanted</span>
                <h1 class="hero-title">業務委託パートナー募集</h1>
                <p class="hero-subtitle">一般事務・カスタマーサポート業務</p>
                <p class="hero-description">
                    kanucardでは、事業拡大に伴い<br class="sp-only">業務委託パートナーを募集しています。<br>
                    在宅ワーク可能・柔軟な働き方ができます。
                </p>
                <a href="#application-form" class="hero-cta">応募フォームへ</a>
            </div>
        </div>
    </section>

    <!-- Job Description Section -->
    <section class="recruitment-section job-description">
        <div class="recruitment-container">
            <h2 class="section-title" data-aos="fade-up">
                <span class="title-en">Job Description</span>
                業務内容
            </h2>
            <div class="job-cards" data-aos="fade-up" data-aos-delay="100">
                <div class="job-card">
                    <div class="job-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3>一般事務</h3>
                    <p>データ入力、書類作成、メール対応などの事務作業をお任せします。</p>
                </div>
                <div class="job-card">
                    <div class="job-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>カスタマーサポート</h3>
                    <p>お客様からのお問い合わせ対応、各種手続きのサポートを行います。</p>
                </div>
                <div class="job-card">
                    <div class="job-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3>その他サポート業務</h3>
                    <p>商品発送準備、在庫管理補助など、運営全般のサポート業務です。</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements Section -->
    <section class="recruitment-section requirements">
        <div class="recruitment-container">
            <h2 class="section-title" data-aos="fade-up">
                <span class="title-en">Requirements</span>
                応募条件
            </h2>
            <div class="requirements-content" data-aos="fade-up" data-aos-delay="100">
                <ul class="requirements-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>PC・インターネット環境をお持ちの方</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>基本的なPC操作（メール、Excel、Wordなど）ができる方</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>責任感を持って業務に取り組める方</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>報連相を適切に行える方</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>週10時間以上稼働可能な方</span>
                    </li>
                </ul>
                <div class="benefits-box">
                    <h3><i class="fas fa-gift"></i> 働くメリット</h3>
                    <ul>
                        <li>完全在宅勤務OK</li>
                        <li>勤務時間は柔軟に調整可能</li>
                        <li>長期的にお付き合いできる方歓迎</li>
                        <li>スキルに応じて報酬アップ</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Form Section -->
    <section class="recruitment-section application-section" id="application-form">
        <div class="recruitment-container">
            <h2 class="section-title" data-aos="fade-up">
                <span class="title-en">Application</span>
                応募フォーム
            </h2>

            <?php if ( $is_submitted ): ?>
                <div class="form-success" data-aos="fade-up">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>ご応募ありがとうございます</h3>
                    <p>内容を確認の上、担当者より折り返しご連絡いたします。<br>しばらくお待ちください。</p>
                    <a href="<?php echo home_url(); ?>" class="btn-back">トップページへ戻る</a>
                </div>
            <?php else: ?>
                <?php if ( $form_error ): ?>
                    <div class="form-error" data-aos="fade-up">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo esc_html( $form_error ); ?>
                    </div>
                <?php endif; ?>

                <form method="post" class="recruitment-form" data-aos="fade-up" data-aos-delay="100">
                    <?php wp_nonce_field( 'recruitment_form', 'recruitment_nonce' ); ?>

                    <div class="form-group">
                        <label for="applicant_name">
                            お名前 <span class="required">必須</span>
                        </label>
                        <input type="text" id="applicant_name" name="applicant_name"
                               placeholder="山田 太郎" required
                               value="<?php echo isset( $_POST['applicant_name'] ) ? esc_attr( $_POST['applicant_name'] ) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="applicant_email">
                            メールアドレス <span class="required">必須</span>
                        </label>
                        <input type="email" id="applicant_email" name="applicant_email"
                               placeholder="example@email.com" required
                               value="<?php echo isset( $_POST['applicant_email'] ) ? esc_attr( $_POST['applicant_email'] ) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="applicant_phone">
                            電話番号
                        </label>
                        <input type="tel" id="applicant_phone" name="applicant_phone"
                               placeholder="090-1234-5678"
                               value="<?php echo isset( $_POST['applicant_phone'] ) ? esc_attr( $_POST['applicant_phone'] ) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="applicant_message">
                            志望動機・自己PR <span class="required">必須</span>
                        </label>
                        <textarea id="applicant_message" name="applicant_message" rows="6"
                                  placeholder="ご経験やスキル、稼働可能な時間帯などをご記入ください。"
                                  required><?php echo isset( $_POST['applicant_message'] ) ? esc_textarea( $_POST['applicant_message'] ) : ''; ?></textarea>
                    </div>

                    <div class="form-submit">
                        <button type="submit" name="submit_recruitment" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            応募する
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </section>
</div>

<style>
/* JINスムーズスクロール無効化 + ネイティブスクロール復元 */
#scroll-content {
    transform: none !important;
    position: static !important;
    overflow: visible !important;
    height: auto !important;
}
html, body {
    overflow-x: hidden !important;
    overflow-y: auto !important;
    height: auto !important;
    max-height: none !important;
    -webkit-overflow-scrolling: touch !important;
}
#wrapper {
    overflow: visible !important;
    height: auto !important;
}
</style>

<script>
// JINテーマのスムーズスクロール機能を無効化してネイティブスクロールを復元
(function() {
    var scrollContent = document.getElementById('scroll-content');
    if (scrollContent) {
        // animateクラスを除去してtransformアニメーションを停止
        scrollContent.classList.remove('animate');
        // transformをリセット
        scrollContent.style.transform = 'none';
        scrollContent.style.webkitTransform = 'none';
        scrollContent.style.position = 'static';
        scrollContent.style.overflow = 'visible';
        scrollContent.style.height = 'auto';
        console.log('[Recruitment] #scroll-content のスムーズスクロールを無効化しました');
    }

    // JINのスムーズスクロール用イベントリスナーを無効化
    window.addEventListener('wheel', function(e) { e.stopPropagation(); }, true);
    window.addEventListener('touchmove', function(e) { e.stopPropagation(); }, true);

    console.log('[Recruitment] ネイティブスクロール復元完了');
})();
</script>

<?php get_footer(); ?>
