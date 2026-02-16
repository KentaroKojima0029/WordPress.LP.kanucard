<?php
/**
 * Template Name: 事業者向けPSA代行 LP
 * Template Post Type: page, post
 *
 * PSA鑑定代行サービス 事業者向けランディングページテンプレート
 *
 * @package JIN_Child_Kanucard
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
<title>PSA鑑定代行 事業者向けサービス | 株式会社カヌカード</title>
<meta name="description" content="PSA鑑定代行の事業者向け一括支援。カード選定から提出まで丸投げで収益最大化。週300〜500枚対応、出張選別も可能。まずは無料相談・概算見積から。">
<meta property="og:title" content="PSA鑑定代行 事業者向けサービス | 株式会社カヌカード">
<meta property="og:description" content="PSA鑑定向きカードの選定〜提出まで、店舗向けに一括支援。無料相談・概算見積受付中。">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo get_permalink(); ?>">
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">

<?php wp_head(); ?>

<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"Service",
  "name":"PSA鑑定代行 事業者向けサービス",
  "provider":{"@type":"Organization","name":"株式会社カヌカード","url":"https://kanucard.com"},
  "description":"PSA鑑定代行の事業者向け一括支援サービス。カード選定から提出まで丸投げ対応。",
  "areaServed":"JP"
}
</script>

<style>
/* ============================================================
   B2B LP — 親テーマのスタイルを上書きするためスコープ付き
   ============================================================ */

/* --- 設定値 --- */
.b2b-lp {
  --c-primary: #1C4134;
  --c-primary-light: #143228;
  --c-accent: #D4AF37;
  --c-accent-hover: #c49b2a;
  --c-accent-light: #faf5e4;
  --c-gold: #D4AF37;
  --c-gold-light: #faf5e4;
  --c-text: #0C231C;
  --c-text-light: #3d5a4f;
  --c-bg: #f5f8f6;
  --c-bg-alt: #edf2ef;
  --c-white: #ffffff;
  --c-border: #c8d8d0;
  --c-success: #1C4134;
  --c-warning: #D4AF37;
  --c-danger: #b91c1c;
  --font-base: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
  --lh-base: 1.8;
  --lh-heading: 1.4;
  --section-py: 80px;
  --container-max: 960px;
  --container-px: 20px;
  --radius: 8px;
  --radius-lg: 12px;
  --shadow: 0 1px 3px rgba(0,0,0,.08);
  --shadow-md: 0 4px 12px rgba(0,0,0,.1);
}

/* --- リセット（.b2b-lp スコープ内のみ） --- */
.b2b-lp, .b2b-lp *, .b2b-lp *::before, .b2b-lp *::after { box-sizing: border-box; }
.b2b-lp {
  font-family: var(--font-base) !important;
  font-size: 15px !important;
  line-height: var(--lh-base) !important;
  color: var(--c-text) !important;
  background: var(--c-white) !important;
  overflow-x: hidden;
  margin: 0; padding: 0;
}
.b2b-lp img { max-width: 100%; height: auto; display: block; }
.b2b-lp a { color: var(--c-accent); text-decoration: none; }
.b2b-lp ul, .b2b-lp ol { list-style: none; margin: 0; padding: 0; }
.b2b-lp h1, .b2b-lp h2, .b2b-lp h3, .b2b-lp h4, .b2b-lp h5, .b2b-lp h6 {
  line-height: var(--lh-heading); font-weight: 700; margin: 0; padding: 0;
  border: none; background: none;
}
.b2b-lp table { border-collapse: collapse; width: 100%; }
.b2b-lp p { margin: 0 0 .5em; }

.b2b-lp .b2b-container {
  max-width: var(--container-max);
  margin: 0 auto;
  padding: 0 var(--container-px);
}

.b2b-lp .b2b-section-title {
  font-size: 1.6rem;
  text-align: center;
  margin-bottom: 40px;
  color: var(--c-primary);
  letter-spacing: .02em;
}
.b2b-lp .b2b-section-title small {
  display: block;
  font-size: .85rem;
  font-weight: 400;
  color: var(--c-text-light);
  margin-top: 8px;
}

/* --- ボタン --- */
.b2b-lp .b2b-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 14px 28px;
  border-radius: var(--radius);
  font-size: 1rem;
  font-weight: 700;
  border: none;
  cursor: pointer;
  transition: all .2s ease;
  text-align: center;
  line-height: 1.4;
}
.b2b-lp .b2b-btn-primary { background: var(--c-accent); color: var(--c-white); }
.b2b-lp .b2b-btn-primary:hover { background: var(--c-accent-hover); transform: translateY(-1px); color: var(--c-white); }
.b2b-lp .b2b-btn-outline { background: transparent; color: var(--c-accent); border: 2px solid var(--c-accent); }
.b2b-lp .b2b-btn-outline:hover { background: var(--c-accent); color: var(--c-white); }
.b2b-lp .b2b-btn-gold { background: linear-gradient(135deg, var(--c-gold), #d4a017); color: var(--c-white); }
.b2b-lp .b2b-btn-gold:hover { filter: brightness(1.1); transform: translateY(-1px); color: var(--c-white); }
.b2b-lp .b2b-btn-lg { padding: 16px 36px; font-size: 1.05rem; }

/* --- ヘッダー --- */
.b2b-lp .b2b-header {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 100;
  background: rgba(255,255,255,.97);
  border-bottom: 1px solid var(--c-border);
  backdrop-filter: blur(6px);
}
.b2b-lp .b2b-header-inner {
  max-width: var(--container-max);
  margin: 0 auto;
  padding: 0 var(--container-px);
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 60px;
}
.b2b-lp .b2b-header-logo {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--c-primary);
  letter-spacing: .04em;
}
.b2b-lp .b2b-header-logo span { color: var(--c-accent); }
.b2b-lp .b2b-header-nav { display: flex; gap: 24px; }
.b2b-lp .b2b-header-nav a {
  font-size: .85rem;
  color: var(--c-text-light);
  font-weight: 500;
  transition: color .2s;
}
.b2b-lp .b2b-header-nav a:hover { color: var(--c-accent); }
.b2b-lp .b2b-header-cta .b2b-btn { padding: 8px 20px; font-size: .85rem; }

/* --- ファーストビュー --- */
.b2b-lp .b2b-hero {
  padding: 120px 0 80px;
  background: linear-gradient(160deg, var(--c-primary) 0%, var(--c-primary-light) 100%);
  color: var(--c-white);
  text-align: center;
}
.b2b-lp .b2b-hero-badge {
  display: inline-block;
  background: rgba(255,255,255,.12);
  border: 1px solid rgba(255,255,255,.2);
  border-radius: 40px;
  padding: 6px 20px;
  font-size: .8rem;
  margin-bottom: 24px;
  letter-spacing: .06em;
}
.b2b-lp .b2b-hero h1 {
  font-size: 1.8rem;
  margin-bottom: 16px;
  letter-spacing: .03em;
  color: var(--c-white);
}
.b2b-lp .b2b-hero h1 .accent { color: #D4AF37; }
.b2b-lp .b2b-hero-sub {
  font-size: 1rem;
  opacity: .9;
  margin-bottom: 12px;
  line-height: 1.7;
  color: var(--c-white);
}
.b2b-lp .b2b-hero-target {
  display: inline-block;
  background: rgba(255,255,255,.1);
  border-radius: var(--radius);
  padding: 8px 16px;
  font-size: .85rem;
  margin-bottom: 32px;
  opacity: .85;
}
.b2b-lp .b2b-hero-cta {
  display: flex;
  gap: 12px;
  justify-content: center;
  flex-wrap: wrap;
  margin-bottom: 32px;
}
.b2b-lp .b2b-hero-stats {
  display: flex;
  gap: 24px;
  justify-content: center;
  flex-wrap: wrap;
}
.b2b-lp .b2b-hero-stat { text-align: center; }
.b2b-lp .b2b-hero-stat-num {
  font-size: 1.6rem;
  font-weight: 800;
  display: block;
  color: #D4AF37;
}
.b2b-lp .b2b-hero-stat-label { font-size: .75rem; opacity: .8; }
.b2b-lp .b2b-hero-stat-note { font-size: .65rem; opacity: .6; display: block; margin-top: 2px; }

/* --- 課題 → 解決 --- */
.b2b-lp .b2b-problems { padding: var(--section-py) 0; background: var(--c-bg); }
.b2b-lp .b2b-problem-list { display: grid; gap: 16px; margin-bottom: 32px; }
.b2b-lp .b2b-problem-item {
  display: flex; align-items: flex-start; gap: 12px;
  background: var(--c-white); border-radius: var(--radius);
  padding: 16px 20px; box-shadow: var(--shadow);
  border-left: 4px solid var(--c-accent);
}
.b2b-lp .b2b-problem-icon {
  flex-shrink: 0; width: 28px; height: 28px;
  background: var(--c-accent-light); border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: var(--c-accent); font-size: .85rem; font-weight: 700;
}
.b2b-lp .b2b-problem-text { font-size: .95rem; }
.b2b-lp .b2b-solution-box {
  background: var(--c-accent-light); border-radius: var(--radius-lg);
  padding: 24px; text-align: center; border: 1px solid var(--c-accent);
}
.b2b-lp .b2b-solution-box p { font-size: 1.05rem; font-weight: 700; color: var(--c-accent); }

/* --- 3つの提供価値 --- */
.b2b-lp .b2b-values { padding: var(--section-py) 0; }
.b2b-lp .b2b-values-grid { display: grid; gap: 20px; }
.b2b-lp .b2b-value-card {
  background: var(--c-white); border: 1px solid var(--c-border);
  border-radius: var(--radius-lg); padding: 28px 24px;
  box-shadow: var(--shadow); transition: box-shadow .2s;
}
.b2b-lp .b2b-value-card:hover { box-shadow: var(--shadow-md); }
.b2b-lp .b2b-value-num {
  display: inline-flex; align-items: center; justify-content: center;
  width: 36px; height: 36px; border-radius: 50%;
  background: var(--c-accent); color: var(--c-white);
  font-size: .9rem; font-weight: 800; margin-bottom: 12px;
}
.b2b-lp .b2b-value-card h3 { font-size: 1.15rem; margin-bottom: 8px; color: var(--c-primary); }
.b2b-lp .b2b-value-card p { font-size: .9rem; color: var(--c-text-light); }
.b2b-lp .b2b-value-note {
  font-size: .75rem; color: var(--c-text-light);
  margin-top: 8px; padding-top: 8px; border-top: 1px dashed var(--c-border);
}

/* --- プラン比較 --- */
.b2b-lp .b2b-plans { padding: var(--section-py) 0; background: var(--c-bg); }
.b2b-lp .b2b-plan-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 24px; }
.b2b-lp .b2b-plan-table { min-width: 540px; font-size: .9rem; }
.b2b-lp .b2b-plan-table th, .b2b-lp .b2b-plan-table td {
  padding: 14px 16px; border: 1px solid var(--c-border);
  text-align: left; vertical-align: top;
}
.b2b-lp .b2b-plan-table thead th {
  background: var(--c-primary); color: var(--c-white);
  font-weight: 700; text-align: center;
}
.b2b-lp .b2b-plan-table thead th:first-child { background: var(--c-primary-light); }
.b2b-lp .b2b-plan-table tbody th { background: var(--c-bg-alt); font-weight: 600; white-space: nowrap; }
.b2b-lp .b2b-plan-table tbody td { background: var(--c-white); }
.b2b-lp .b2b-plan-cost-note {
  background: var(--c-gold-light); border: 1px solid var(--c-gold);
  border-radius: var(--radius); padding: 16px 20px; font-size: .85rem;
}
.b2b-lp .b2b-plan-cost-note strong { color: var(--c-gold); }

/* --- 目安 --- */
.b2b-lp .b2b-specs { padding: var(--section-py) 0; }
.b2b-lp .b2b-specs-grid { display: grid; gap: 16px; }
.b2b-lp .b2b-spec-item {
  display: flex; gap: 12px; align-items: flex-start;
  background: var(--c-bg); border-radius: var(--radius); padding: 16px 20px;
}
.b2b-lp .b2b-spec-label {
  flex-shrink: 0; font-weight: 700; font-size: .85rem;
  color: var(--c-accent); min-width: 80px;
}
.b2b-lp .b2b-spec-value { font-size: .95rem; }
.b2b-lp .b2b-specs-note {
  margin-top: 20px; font-size: .75rem; color: var(--c-text-light);
  text-align: center; line-height: 1.7;
}

/* --- 導入までの流れ --- */
.b2b-lp .b2b-flow { padding: var(--section-py) 0; background: var(--c-bg); }
.b2b-lp .b2b-flow-steps { display: flex; flex-direction: column; gap: 0; position: relative; }
.b2b-lp .b2b-flow-step {
  display: flex; gap: 16px; align-items: flex-start;
  padding-bottom: 32px; position: relative;
}
.b2b-lp .b2b-flow-step:last-child { padding-bottom: 0; }
.b2b-lp .b2b-flow-step-num {
  flex-shrink: 0; width: 40px; height: 40px; border-radius: 50%;
  background: var(--c-accent); color: var(--c-white);
  display: flex; align-items: center; justify-content: center;
  font-weight: 800; font-size: .9rem; position: relative; z-index: 2;
}
.b2b-lp .b2b-flow-step:not(:last-child) .b2b-flow-step-num::after {
  content: ""; position: absolute; top: 40px; left: 50%;
  transform: translateX(-50%); width: 2px;
  height: calc(100% + 32px - 40px);
  background: var(--c-accent); opacity: .2; z-index: 1;
}
.b2b-lp .b2b-flow-step-content h3 { font-size: 1rem; margin-bottom: 4px; color: var(--c-primary); }
.b2b-lp .b2b-flow-step-content p { font-size: .85rem; color: var(--c-text-light); }

/* --- FAQ --- */
.b2b-lp .b2b-faq { padding: var(--section-py) 0; }
.b2b-lp .b2b-faq-list { max-width: 720px; margin: 0 auto; }
.b2b-lp .b2b-faq-item { border-bottom: 1px solid var(--c-border); }
.b2b-lp .b2b-faq-q {
  width: 100%; background: none; border: none;
  display: flex; align-items: center; justify-content: space-between; gap: 12px;
  padding: 18px 0; font-size: .95rem; font-weight: 600;
  color: var(--c-text); cursor: pointer; text-align: left;
  font-family: inherit; line-height: 1.6;
}
.b2b-lp .b2b-faq-q::after {
  content: "+"; flex-shrink: 0; width: 28px; height: 28px;
  border-radius: 50%; background: var(--c-bg);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem; font-weight: 400; color: var(--c-text-light);
  transition: transform .2s;
}
.b2b-lp .b2b-faq-item.open .b2b-faq-q::after {
  content: "\2212"; background: var(--c-accent); color: var(--c-white);
}
.b2b-lp .b2b-faq-a { max-height: 0; overflow: hidden; transition: max-height .3s ease, padding .3s ease; }
.b2b-lp .b2b-faq-item.open .b2b-faq-a { max-height: 300px; padding-bottom: 18px; }
.b2b-lp .b2b-faq-a p { font-size: .9rem; color: var(--c-text-light); line-height: 1.8; }

/* --- 信頼情報 --- */
.b2b-lp .b2b-trust { padding: var(--section-py) 0; background: var(--c-bg); }
.b2b-lp .b2b-trust-grid { display: grid; gap: 12px; }
.b2b-lp .b2b-trust-item { display: flex; gap: 12px; align-items: flex-start; font-size: .9rem; }
.b2b-lp .b2b-trust-label { flex-shrink: 0; font-weight: 700; color: var(--c-primary); min-width: 100px; }

/* --- フォーム --- */
.b2b-lp .b2b-form-section { padding: var(--section-py) 0; background: var(--c-primary); color: var(--c-white); }
.b2b-lp .b2b-form-section .b2b-section-title { color: var(--c-white); }
.b2b-lp .b2b-form-section .b2b-section-title small { color: rgba(255,255,255,.7); }
.b2b-lp .b2b-form-wrap {
  max-width: 600px; margin: 0 auto; background: var(--c-white);
  border-radius: var(--radius-lg); padding: 32px 28px; color: var(--c-text);
}
.b2b-lp .b2b-form-group { margin-bottom: 20px; }
.b2b-lp .b2b-form-group label {
  display: block; font-size: .85rem; font-weight: 600;
  margin-bottom: 6px; color: var(--c-text);
}
.b2b-lp .b2b-form-group label .req { color: var(--c-danger); font-size: .75rem; margin-left: 4px; }
.b2b-lp .b2b-form-group input,
.b2b-lp .b2b-form-group select,
.b2b-lp .b2b-form-group textarea {
  width: 100%; padding: 12px 14px; border: 1px solid var(--c-border);
  border-radius: var(--radius); font-size: .95rem; font-family: inherit;
  background: var(--c-bg); transition: border-color .2s; color: var(--c-text);
}
.b2b-lp .b2b-form-group input:focus,
.b2b-lp .b2b-form-group select:focus,
.b2b-lp .b2b-form-group textarea:focus {
  outline: none; border-color: var(--c-accent);
  box-shadow: 0 0 0 3px rgba(37,99,235,.1);
}
.b2b-lp .b2b-form-group textarea { resize: vertical; min-height: 100px; }
.b2b-lp .b2b-form-submit { text-align: center; margin-top: 24px; }
.b2b-lp .b2b-form-submit .b2b-btn { width: 100%; max-width: 320px; }
.b2b-lp .b2b-form-success { display: none; text-align: center; padding: 40px 20px; }
.b2b-lp .b2b-form-success .icon { font-size: 3rem; margin-bottom: 16px; color: var(--c-success); }
.b2b-lp .b2b-form-success h3 { font-size: 1.2rem; margin-bottom: 8px; }
.b2b-lp .b2b-form-success p { font-size: .9rem; color: var(--c-text-light); }

/* --- 法的注記 --- */
.b2b-lp .b2b-legal { padding: 40px 0; background: var(--c-bg-alt); border-top: 1px solid var(--c-border); }
.b2b-lp .b2b-legal-title { font-size: .85rem; font-weight: 700; color: var(--c-text); margin-bottom: 12px; }
.b2b-lp .b2b-legal-list { font-size: .75rem; color: var(--c-text-light); line-height: 1.9; }
.b2b-lp .b2b-legal-list li { padding-left: 1em; text-indent: -1em; }
.b2b-lp .b2b-legal-list li::before { content: "\203B"; margin-right: .3em; }

/* --- フッター --- */
.b2b-lp .b2b-footer {
  padding: 32px 0; background: var(--c-primary);
  color: rgba(255,255,255,.7); text-align: center; font-size: .8rem;
}
.b2b-lp .b2b-footer a { color: rgba(255,255,255,.7); }
.b2b-lp .b2b-footer a:hover { color: var(--c-white); }

/* --- 中間CTA --- */
.b2b-lp .b2b-mid-cta {
  padding: 48px 0;
  background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-light) 100%);
  text-align: center; color: var(--c-white);
}
.b2b-lp .b2b-mid-cta p { font-size: 1.1rem; font-weight: 600; margin-bottom: 20px; color: var(--c-white); }
.b2b-lp .b2b-mid-cta .b2b-cta-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* --- 固定CTA --- */
.b2b-fixed-cta {
  position: fixed; bottom: 0; left: 0; right: 0; z-index: 90;
  background: rgba(255,255,255,.97); border-top: 1px solid #e2e8f0;
  padding: 10px 20px; display: flex; gap: 8px; justify-content: center;
  backdrop-filter: blur(6px); transform: translateY(100%); transition: transform .3s ease;
}
.b2b-fixed-cta.visible { transform: translateY(0); }
.b2b-fixed-cta .b2b-btn { font-size: .85rem; padding: 10px 20px; flex: 1; max-width: 200px; }

/* --- レスポンシブ --- */
@media (min-width: 600px) {
  .b2b-lp .b2b-values-grid { grid-template-columns: repeat(3, 1fr); }
  .b2b-lp .b2b-hero h1 { font-size: 2.2rem; }
  .b2b-lp .b2b-section-title { font-size: 1.8rem; }
  .b2b-lp .b2b-specs-grid { grid-template-columns: 1fr 1fr; }
  .b2b-lp .b2b-trust-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 599px) {
  .b2b-lp {
    --section-py: 56px;
    --container-px: 16px;
    font-size: 14px !important;
  }
  .b2b-lp .b2b-hero { padding: 100px 0 60px; }
  .b2b-lp .b2b-hero h1 { font-size: 1.4rem; }
  .b2b-lp .b2b-section-title { font-size: 1.3rem; margin-bottom: 28px; }
  .b2b-lp .b2b-hero-stats { gap: 16px; }
  .b2b-lp .b2b-hero-stat-num { font-size: 1.3rem; }
  .b2b-lp .b2b-header-nav { display: none; }
  .b2b-lp .b2b-header-cta { display: none; }
  .b2b-lp .b2b-form-wrap { padding: 24px 16px; }
  .b2b-lp .b2b-plan-table { font-size: .82rem; }
  .b2b-lp .b2b-plan-table th, .b2b-lp .b2b-plan-table td { padding: 10px 12px; }
}
</style>
</head>

<body <?php body_class('b2b-lp-page'); ?>>
<?php wp_body_open(); ?>

<div class="b2b-lp">

<!-- ヘッダー -->
<header class="b2b-header">
  <div class="b2b-header-inner">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="b2b-header-logo">kanu<span>card</span></a>
    <nav class="b2b-header-nav">
      <a href="#b2b-values">サービス</a>
      <a href="#b2b-plans">プラン</a>
      <a href="#b2b-flow">導入の流れ</a>
      <a href="#b2b-faq">FAQ</a>
      <a href="#b2b-contact">お問い合わせ</a>
    </nav>
    <div class="b2b-header-cta">
      <a href="#b2b-contact" class="b2b-btn b2b-btn-primary">無料相談</a>
    </div>
  </div>
</header>

<!-- (1) ファーストビュー -->
<section class="b2b-hero" id="b2b-top">
  <div class="b2b-container">
    <div class="b2b-hero-badge">事業者・店舗向け PSA鑑定代行</div>
    <h1>鑑定品の取扱いを効率化。<br><span class="accent">丸投げで収益最大化。</span></h1>
    <p class="b2b-hero-sub">PSA鑑定向きカードの選定から提出まで、<br>店舗運営に最適化した一括支援サービス</p>
    <p class="b2b-hero-target">カードショップ / EC事業者 / 買取業者 / イベント運営 など</p>
    <div class="b2b-hero-cta">
      <a href="#b2b-contact" class="b2b-btn b2b-btn-primary b2b-btn-lg">無料相談する</a>
      <a href="#b2b-contact" class="b2b-btn b2b-btn-outline b2b-btn-lg" style="border-color:rgba(255,255,255,.5);color:#fff;">概算見積を依頼</a>
    </div>
    <div class="b2b-hero-stats">
      <div class="b2b-hero-stat">
        <span class="b2b-hero-stat-num">300〜500枚</span>
        <span class="b2b-hero-stat-label">週間対応枚数（目安）</span>
        <span class="b2b-hero-stat-note">状況により変動</span>
      </div>
      <div class="b2b-hero-stat">
        <span class="b2b-hero-stat-num">1.5〜6ヶ月</span>
        <span class="b2b-hero-stat-label">納期目安</span>
        <span class="b2b-hero-stat-note">プラン・混雑で変動</span>
      </div>
      <div class="b2b-hero-stat">
        <span class="b2b-hero-stat-num">89%超</span>
        <span class="b2b-hero-stat-label">PSA10取得率</span>
        <span class="b2b-hero-stat-note">対象・期間・基準で変動</span>
      </div>
    </div>
  </div>
</section>

<!-- (2) 課題 → 解決 -->
<section class="b2b-problems" id="b2b-problems">
  <div class="b2b-container">
    <h2 class="b2b-section-title">こんな課題、抱えていませんか？<small>多くの店舗が直面するPSA鑑定のボトルネック</small></h2>
    <div class="b2b-problem-list">
      <div class="b2b-problem-item">
        <div class="b2b-problem-icon">1</div>
        <p class="b2b-problem-text"><strong>選別工数が重い</strong> ── 大量カードからPSA向きを選ぶ作業で人件費が膨らむ</p>
      </div>
      <div class="b2b-problem-item">
        <div class="b2b-problem-icon">2</div>
        <p class="b2b-problem-text"><strong>PSA向きが分からない</strong> ── どのカードを出せば良いか判断基準がなく、不採算になりやすい</p>
      </div>
      <div class="b2b-problem-item">
        <div class="b2b-problem-icon">3</div>
        <p class="b2b-problem-text"><strong>大量処理のオペが回らない</strong> ── 仕分け・梱包・発送に追われ、本業が圧迫される</p>
      </div>
      <div class="b2b-problem-item">
        <div class="b2b-problem-icon">4</div>
        <p class="b2b-problem-text"><strong>海外提出のリスクが読めない</strong> ── 輸送事故・為替変動・関税対応に不安がある</p>
      </div>
    </div>
    <div class="b2b-solution-box">
      <p>これらすべてを、当社の事業者向け一括代行で解決します。</p>
    </div>
  </div>
</section>

<!-- (3) 3つの提供価値 -->
<section class="b2b-values" id="b2b-values">
  <div class="b2b-container">
    <h2 class="b2b-section-title">3つの提供価値<small>店舗オペレーションに最適化した支援体制</small></h2>
    <div class="b2b-values-grid">
      <div class="b2b-value-card">
        <div class="b2b-value-num">1</div>
        <h3>人件費削減</h3>
        <p>大量のカードもまるごと委託可能。選別・仕分け・梱包の作業負担を大幅に軽減し、スタッフをコア業務に集中させます。</p>
      </div>
      <div class="b2b-value-card">
        <div class="b2b-value-num">2</div>
        <h3>カード選定</h3>
        <p>PSA10が期待できるカードをプロの目で厳選。見込みの薄いカードに鑑定料をかけず、投資対効果を最大化します。</p>
        <p class="b2b-value-note">PSA10の取得を保証するものではありません。対象カード・時期・コンディションにより結果は変動します。</p>
      </div>
      <div class="b2b-value-card">
        <div class="b2b-value-num">3</div>
        <h3>一括代行</h3>
        <p>店舗訪問による現地確認も可能。仕分けから発送までの手間を一括で引き受け、オペレーション負荷を最小化します。</p>
      </div>
    </div>
  </div>
</section>

<!-- 中間CTA -->
<section class="b2b-mid-cta">
  <div class="b2b-container">
    <p>まずはお気軽にご相談ください</p>
    <div class="b2b-cta-btns">
      <a href="#b2b-contact" class="b2b-btn b2b-btn-gold b2b-btn-lg">無料相談する</a>
      <a href="#b2b-contact" class="b2b-btn b2b-btn-outline b2b-btn-lg" style="border-color:rgba(255,255,255,.5);color:#fff;">概算見積を依頼</a>
    </div>
  </div>
</section>

<!-- (4) プラン比較 -->
<section class="b2b-plans" id="b2b-plans">
  <div class="b2b-container">
    <h2 class="b2b-section-title">プラン比較<small>お客様の運用体制に合わせて選択できます</small></h2>
    <div class="b2b-plan-table-wrap">
      <table class="b2b-plan-table">
        <thead>
          <tr><th></th><th>郵送型プラン</th><th>出張型プラン</th></tr>
        </thead>
        <tbody>
          <tr><th>概要</th><td>店舗から当社へカードを送付。1枚ずつ精査し、見込みの薄いカードは返却</td><td>当社スタッフが店舗を訪問し現地で選別。対象外カードを送らず効率化</td></tr>
          <tr><th>選別方法</th><td>到着後に社内で精査</td><td>店舗にて対面で選別</td></tr>
          <tr><th>メリット</th><td>遠方でも利用可能。少量〜中量に最適</td><td>無駄な送料を削減。大量処理に強い</td></tr>
          <tr><th>向いている店舗</th><td>遠方の店舗、月100〜300枚程度</td><td>大量在庫を持つ店舗、月300枚以上</td></tr>
          <tr><th>料金</th><td>別途ご相談</td><td>別途ご相談</td></tr>
        </tbody>
      </table>
    </div>
    <div class="b2b-plan-cost-note">
      <strong>費用の考え方：</strong>
      料金は「PSA鑑定料（PSA社公式価格）」「代行手数料」「送料」「保険料」の組み合わせとなります。枚数・プラン・カード内容により変動するため、まずは概算見積をご依頼ください。
    </div>
  </div>
</section>

<!-- (5) 目安 -->
<section class="b2b-specs" id="b2b-specs">
  <div class="b2b-container">
    <h2 class="b2b-section-title">サービス目安<small>主な対応範囲の参考情報</small></h2>
    <div class="b2b-specs-grid">
      <div class="b2b-spec-item"><span class="b2b-spec-label">対応枚数</span><span class="b2b-spec-value">週300〜500枚程度（状況・時期により変動）</span></div>
      <div class="b2b-spec-item"><span class="b2b-spec-label">納期</span><span class="b2b-spec-value">1.5ヶ月〜6ヶ月（プラン・PSA社の混雑状況で変動）</span></div>
      <div class="b2b-spec-item"><span class="b2b-spec-label">対象カード</span><span class="b2b-spec-value">ポケモンカード / その他TCG / 未開封パック 等</span></div>
      <div class="b2b-spec-item"><span class="b2b-spec-label">対応エリア</span><span class="b2b-spec-value">全国対応（出張型は別途ご相談）</span></div>
    </div>
    <p class="b2b-specs-note">上記はいずれも目安であり、保証値ではありません。<br>具体的な条件はヒアリング後にご提示いたします。</p>
  </div>
</section>

<!-- (6) 導入までの流れ -->
<section class="b2b-flow" id="b2b-flow">
  <div class="b2b-container">
    <h2 class="b2b-section-title">導入までの流れ<small>5ステップで運用開始</small></h2>
    <div class="b2b-flow-steps">
      <div class="b2b-flow-step"><div class="b2b-flow-step-num">1</div><div class="b2b-flow-step-content"><h3>お問い合わせ</h3><p>本ページのフォームまたはメールでご連絡ください。</p></div></div>
      <div class="b2b-flow-step"><div class="b2b-flow-step-num">2</div><div class="b2b-flow-step-content"><h3>ヒアリング</h3><p>取扱カード・枚数・ご要望を伺い、最適なプランを検討します。</p></div></div>
      <div class="b2b-flow-step"><div class="b2b-flow-step-num">3</div><div class="b2b-flow-step-content"><h3>ご提案・概算見積</h3><p>プラン・費用感・スケジュールをまとめてご提示します。</p></div></div>
      <div class="b2b-flow-step"><div class="b2b-flow-step-num">4</div><div class="b2b-flow-step-content"><h3>ご契約</h3><p>条件合意後に契約締結。NDA（秘密保持契約）の締結も可能です。</p></div></div>
      <div class="b2b-flow-step"><div class="b2b-flow-step-num">5</div><div class="b2b-flow-step-content"><h3>運用開始</h3><p>カードの受入を開始。定期レポートで進捗を共有します。</p></div></div>
    </div>
  </div>
</section>

<!-- (7) FAQ -->
<section class="b2b-faq" id="b2b-faq">
  <div class="b2b-container">
    <h2 class="b2b-section-title">よくあるご質問<small>事業者のお客様からいただく主な質問</small></h2>
    <div class="b2b-faq-list">
      <div class="b2b-faq-item"><button class="b2b-faq-q" type="button">PSA10は保証されますか？</button><div class="b2b-faq-a"><p>PSA10の取得を保証するものではありません。当社はPSA10が期待できるカードを選定・提出しますが、最終的なグレードはPSA社の鑑定基準に基づきます。取得率は対象カード・時期・コンディションにより変動します。</p></div></div>
      <div class="b2b-faq-item"><button class="b2b-faq-q" type="button">カードの紛失・破損時の責任範囲は？</button><div class="b2b-faq-a"><p>輸送中および保管中の事故に備え、賠償責任保険に加入しています。補償上限額や適用条件は契約時にご説明し、書面にて明確化します。高額カードについては追加保険のご相談も承ります。</p></div></div>
      <div class="b2b-faq-item"><button class="b2b-faq-q" type="button">対象外カードの返却はどうなりますか？</button><div class="b2b-faq-a"><p>選別の結果、PSA提出対象外となったカードは元払いまたは着払い（ご契約条件による）で返却いたします。返却方法・費用負担は事前にお打ち合わせのうえ決定します。</p></div></div>
      <div class="b2b-faq-item"><button class="b2b-faq-q" type="button">最低ロット（最小枚数）はありますか？</button><div class="b2b-faq-a"><p>事業者向けサービスのため、原則としてまとまった枚数でのご依頼を想定していますが、厳密な最低ロットは設けていません。少量からのスタートも含め、お気軽にご相談ください。</p></div></div>
      <div class="b2b-faq-item"><button class="b2b-faq-q" type="button">支払条件はどのようになりますか？</button><div class="b2b-faq-a"><p>前払い・請求書払い（月末締め翌月払い等）など、お客様のご要望に応じて柔軟に対応いたします。詳細はヒアリング時にご相談ください。</p></div></div>
      <div class="b2b-faq-item"><button class="b2b-faq-q" type="button">機密保持（NDA）は締結できますか？</button><div class="b2b-faq-a"><p>はい、NDA（秘密保持契約）の締結が可能です。取引内容・カード情報・取引条件等を秘密情報として保護します。お客様側のNDAフォーマットにも対応可能です。</p></div></div>
    </div>
  </div>
</section>

<!-- (8) 信頼情報 -->
<section class="b2b-trust" id="b2b-company">
  <div class="b2b-container">
    <h2 class="b2b-section-title">運営会社</h2>
    <div class="b2b-trust-grid">
      <div class="b2b-trust-item"><span class="b2b-trust-label">会社名</span><span>株式会社カヌカード</span></div>
      <div class="b2b-trust-item"><span class="b2b-trust-label">許認可</span><span>古物商許可 第62212R057829号</span></div>
      <div class="b2b-trust-item"><span class="b2b-trust-label">メール</span><span>contact@kanucard.com</span></div>
      <div class="b2b-trust-item"><span class="b2b-trust-label">対応エリア</span><span>全国（出張型は地域によりご相談）</span></div>
      <div class="b2b-trust-item"><span class="b2b-trust-label">保険</span><span>賠償責任保険加入済み</span></div>
      <div class="b2b-trust-item"><span class="b2b-trust-label">運用品質</span><span>標準化された検品・梱包プロセスで品質を維持</span></div>
    </div>
  </div>
</section>

<!-- お問い合わせフォーム -->
<section class="b2b-form-section" id="b2b-contact">
  <div class="b2b-container">
    <h2 class="b2b-section-title">無料相談・概算見積<small>以下のフォームからお気軽にお問い合わせください</small></h2>
    <div class="b2b-form-wrap">
      <form id="b2bContactForm" novalidate>
        <div class="b2b-form-group"><label for="bf-company">会社名 <span class="req">必須</span></label><input type="text" id="bf-company" name="company" required placeholder="例：株式会社〇〇"></div>
        <div class="b2b-form-group"><label for="bf-name">担当者名 <span class="req">必須</span></label><input type="text" id="bf-name" name="name" required placeholder="例：山田 太郎"></div>
        <div class="b2b-form-group"><label for="bf-email">メールアドレス <span class="req">必須</span></label><input type="email" id="bf-email" name="email" required placeholder="例：info@example.com"></div>
        <div class="b2b-form-group"><label for="bf-tel">電話番号</label><input type="tel" id="bf-tel" name="tel" placeholder="例：03-1234-5678"></div>
        <div class="b2b-form-group">
          <label for="bf-type">店舗形態 <span class="req">必須</span></label>
          <select id="bf-type" name="store_type" required>
            <option value="">選択してください</option>
            <option value="card_shop">カードショップ（実店舗）</option>
            <option value="ec">ECショップ</option>
            <option value="buyer">買取業者</option>
            <option value="event">イベント運営</option>
            <option value="other">その他</option>
          </select>
        </div>
        <div class="b2b-form-group">
          <label for="bf-volume">月の想定枚数 <span class="req">必須</span></label>
          <select id="bf-volume" name="volume" required>
            <option value="">選択してください</option>
            <option value="~100">〜100枚</option>
            <option value="100-300">100〜300枚</option>
            <option value="300-500">300〜500枚</option>
            <option value="500+">500枚以上</option>
          </select>
        </div>
        <div class="b2b-form-group">
          <label for="bf-plan">希望プラン</label>
          <select id="bf-plan" name="plan">
            <option value="">選択してください</option>
            <option value="mail">郵送型</option>
            <option value="visit">出張型</option>
            <option value="undecided">未定・相談したい</option>
          </select>
        </div>
        <div class="b2b-form-group"><label for="bf-message">相談内容</label><textarea id="bf-message" name="message" rows="4" placeholder="ご質問・ご要望があればご記入ください"></textarea></div>
        <div class="b2b-form-submit"><button type="submit" class="b2b-btn b2b-btn-primary b2b-btn-lg">送信する</button></div>
      </form>
      <div class="b2b-form-success" id="b2bFormSuccess">
        <div class="icon">&#10003;</div>
        <h3>送信ありがとうございました。</h3>
        <p>内容を確認のうえ、担当者より折り返しご連絡いたします。</p>
      </div>
    </div>
  </div>
</section>

<!-- (9) 法的・リスク注記 -->
<section class="b2b-legal">
  <div class="b2b-container">
    <h3 class="b2b-legal-title">ご注意事項・免責</h3>
    <ul class="b2b-legal-list">
      <li>PSA鑑定のグレード（PSA10等）を保証するものではありません。最終的なグレードはPSA社の鑑定基準に基づきます。</li>
      <li>「PSA10取得率89%超」は特定期間・特定条件における実績値であり、すべてのお客様・カードに同一の結果を保証するものではありません。対象カード・時期・コンディション等により変動します。</li>
      <li>輸送中および保管中のカードに対する補償範囲・上限額は、個別のご契約書にて定義します。</li>
      <li>キャンセル・返却の条件（手数料・送料負担等）は、ご契約時に書面にて明示いたします。</li>
      <li>お預かりする個人情報・取引情報は適切に管理し、第三者への提供は行いません。ご要望に応じてNDA（秘密保持契約）を締結いたします。</li>
      <li>本ページの内容は予告なく変更される場合があります。最新情報はお問い合わせにてご確認ください。</li>
    </ul>
  </div>
</section>

<!-- フッター -->
<footer class="b2b-footer">
  <div class="b2b-container">
    <p>&copy; <?php echo date('Y'); ?> 株式会社カヌカード. All rights reserved.</p>
    <p style="margin-top:4px;"><a href="<?php echo esc_url(home_url('/')); ?>">kanucard.com</a> | <a href="mailto:contact@kanucard.com">contact@kanucard.com</a></p>
  </div>
</footer>

</div><!-- /.b2b-lp -->

<!-- 固定CTA -->
<div class="b2b-fixed-cta" id="b2bFixedCta">
  <a href="#b2b-contact" class="b2b-btn b2b-btn-primary">無料相談</a>
  <a href="#b2b-contact" class="b2b-btn b2b-btn-outline">概算見積</a>
</div>

<!-- JavaScript -->
<script>
(function() {
  'use strict';

  /* FAQアコーディオン */
  document.querySelectorAll('.b2b-faq-q').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = this.parentElement;
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.b2b-faq-item.open').forEach(function(el) { el.classList.remove('open'); });
      if (!isOpen) item.classList.add('open');
    });
  });

  /* スムーススクロール */
  document.querySelectorAll('a[href^="#b2b-"]').forEach(function(a) {
    a.addEventListener('click', function(e) {
      var target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        var top = target.getBoundingClientRect().top + window.pageYOffset - 70;
        window.scrollTo({ top: top, behavior: 'smooth' });
      }
    });
  });

  /* 固定CTA表示制御 */
  var fixedCta = document.getElementById('b2bFixedCta');
  var formSection = document.getElementById('b2b-contact');
  function toggleFixedCta() {
    var scrollY = window.pageYOffset;
    var formTop = formSection.getBoundingClientRect().top + scrollY;
    if (scrollY > 600 && scrollY < formTop - window.innerHeight) {
      fixedCta.classList.add('visible');
    } else {
      fixedCta.classList.remove('visible');
    }
  }
  window.addEventListener('scroll', toggleFixedCta, { passive: true });
  toggleFixedCta();

  /* フォーム送信（ダミー） */
  var form = document.getElementById('b2bContactForm');
  var success = document.getElementById('b2bFormSuccess');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    var required = form.querySelectorAll('[required]');
    var valid = true;
    required.forEach(function(el) {
      if (!el.value.trim()) { el.style.borderColor = '#b91c1c'; valid = false; }
      else { el.style.borderColor = ''; }
    });
    var email = form.querySelector('[type="email"]');
    if (email && email.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
      email.style.borderColor = '#b91c1c'; valid = false;
    }
    if (!valid) return;
    form.style.display = 'none';
    success.style.display = 'block';
  });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
