# Kanucard Landing Page

WordPressカスタムランディングページ - JIN子テーマ版

## 概要

kanucard.com用のプロフェッショナルなランディングページです。JINテーマの子テーマとして実装されており、既存サイトを維持しながら特定ページにのみLPデザインを適用できます。

## 特徴

- **JINテーマ互換**: 既存のJINサイトを維持しながらLP機能を追加
- **カスタムページテンプレート**: 特定ページにのみLP適用
- **レスポンシブデザイン**: モバイル完全対応
- **スクロールアニメーション**: AOS（Animate On Scroll）
- **Font Awesomeアイコン**: 豊富なアイコンセット
- **コンタクトフォーム**: Ajax対応の問い合わせフォーム
- **パフォーマンス最適化**: LP以外のページには追加CSSを読み込まない

## インストール方法

### WP Pusherを使用（推奨）

1. WordPressにWP Pusherプラグインをインストール
2. WP Pusher → Install Theme
3. Theme repository: `KentaroKojima0029/WordPress.LP.kanucard`
4. Repository subdirectory: `jin-child-kanucard`
5. Branch: `main`
6. Install Theme をクリック

### 手動インストール

1. `jin-child-kanucard`フォルダをZIP化
2. WordPress管理画面 > 外観 > テーマ > 新規追加 > テーマのアップロード
3. ZIPファイルをアップロードしてインストール

## セットアップ手順

### 1. 子テーマの有効化

外観 → テーマ → 「JIN Child - Kanucard LP」を有効化

**重要**: JINテーマが親テーマとしてインストールされている必要があります。

### 2. LP用固定ページの作成

1. 固定ページ → 新規追加
2. タイトルを入力（例：「ランディングページ」）
3. 右サイドバーの「テンプレート」で **Landing Page** を選択
4. 公開

### 3. ページの確認

作成した固定ページにアクセスすると、JINのヘッダー・フッターを使用しない独立したLPが表示されます。

## ディレクトリ構造

```
jin-child-kanucard/
├── assets/
│   ├── css/
│   │   └── lp.css           # LP専用スタイル
│   ├── js/
│   │   └── lp.js            # LP専用JavaScript
│   └── images/
│       └── services-placeholder.svg
├── functions.php             # 子テーマ機能定義
├── style.css                 # 子テーマ宣言
└── template-lp.php           # LP専用ページテンプレート
```

## カスタマイズ

### コンテンツの編集

`template-lp.php` を編集してセクションの内容を変更できます：
- ヒーローセクション（タイトル、サブタイトル）
- 特徴セクション（アイコン、説明文）
- サービスセクション
- 実績数値
- お客様の声
- 連絡先情報

### デザインの変更

`assets/css/lp.css` のCSS変数を編集：
```css
.lp-site {
    --lp-primary-color: #2563eb;    /* メインカラー */
    --lp-secondary-color: #1e40af;  /* サブカラー */
    --lp-accent-color: #f59e0b;     /* アクセントカラー */
}
```

## 技術スタック

- PHP 7.4+
- WordPress 5.0+
- JINテーマ（親テーマ）
- jQuery
- AOS (Animate On Scroll)
- Font Awesome 6

## 開発フロー

1. ローカルでコードを編集
2. GitHubにプッシュ: `git add . && git commit -m "..." && git push`
3. WP Pusherで更新（自動または手動）

## 注意事項

- JINテーマがインストールされていない場合、子テーマは動作しません
- LP専用のCSS/JSはLPテンプレートを使用するページのみに読み込まれます
- JINテーマの更新は子テーマに影響しません

## ライセンス

GPL v2 or later

## 作成者

Kanucard Team