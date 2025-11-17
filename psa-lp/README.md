# PSA鑑定代行サービス ランディングページ

株式会社カヌカードのPSA鑑定代行サービス専用ランディングページです。

## 概要

訪問者が「思わず代行依頼したくなる」魅力的で信頼性の高いLPを構築しています。

## 特徴

- **レスポンシブデザイン**: モバイルファースト（SP/TB/PC対応）
- **スクロールアニメーション**: Intersection Observer APIを使用
- **カウンターアニメーション**: 実績数値が動的にカウントアップ
- **FAQ アコーディオン**: スムーズな開閉アニメーション
- **パフォーマンス最適化**: Vanilla JavaScript、外部ライブラリ最小限
- **SEO対策**: 構造化データ、適切なタグ階層

## ファイル構成

```
psa-lp/
├── index.html          # メインHTML（スタンドアロン版）
├── css/
│   └── style.css       # スタイルシート
├── js/
│   └── script.js       # JavaScript（アニメーション・インタラクション）
├── images/             # 画像アセット（必要に応じて追加）
└── README.md           # このファイル
```

## 使用方法

### スタンドアロン版

1. `index.html` をブラウザで開く
2. 必要に応じて `css/style.css` でデザインをカスタマイズ
3. `js/script.js` でインタラクションを調整

### WordPress統合版

JIN子テーマに `template-psa-lp.php` が含まれています。

1. JIN子テーマを有効化
2. 固定ページ → 新規追加
3. テンプレート → **PSA代行 Landing Page** を選択
4. 公開

## カスタマイズ

### カラースキーム

`css/style.css` の `:root` で定義：

```css
:root {
    --primary: #2B5AB8;      /* 信頼の青 */
    --secondary: #F59E0B;    /* アクセントのゴールド */
    --success: #10B981;      /* 緑 */
    --danger: #EF4444;       /* 赤 */
}
```

### コンテンツの編集

- **HTML**: セクションごとにコメント付きで構造化
- **実績数値**: `data-count` 属性で変更可能
- **FAQ**: 質問と回答を `.faq-item` 内で編集
- **リンク**: CTAボタンのURL（daiko.kanucard.com、LINE等）

### アニメーション

- `data-aos`: スクロールアニメーションタイプ
- `data-delay`: アニメーション遅延（ミリ秒）
- `.fade-in`, `.delay-1` 等: Hero セクションのアニメーション

## 外部リソース

- **Google Fonts**: Noto Sans JP
- **Font Awesome 6**: アイコン
- **CDN経由**: パフォーマンスと可用性を両立

## 重要なリンク

- 代行フォーム: https://daiko.kanucard.com
- LINE相談: https://line.me/ti/p/2WLUTzIzLD
- メインサイト: https://kanucard.com

## パフォーマンス

- **Vanilla JavaScript**: jQueryに依存しない軽量実装
- **Intersection Observer**: 効率的なスクロール監視
- **CSS Variables**: 一貫性のあるデザインシステム
- **最小限のDOM操作**: 高速なレンダリング

## ブラウザサポート

- Chrome (最新)
- Firefox (最新)
- Safari (最新)
- Edge (最新)
- IE11: サポート対象外

## 今後の拡張

- WebP画像の追加
- コンタクトフォームのAjax実装
- A/Bテスト用のバリエーション
- Google Analytics / Tag Manager統合
- パフォーマンスモニタリング

## ライセンス

Copyright 2024 株式会社カヌカード