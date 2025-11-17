# Kanucard Landing Page Theme

WordPressカスタムランディングページテーマ

## 概要

kanucard.com用のプロフェッショナルなランディングページテーマです。モダンなデザインとアニメーション効果を備えています。

## 特徴

- レスポンシブデザイン（モバイル対応）
- スクロールアニメーション（AOS）
- Font Awesomeアイコン
- カスタマイザー対応
- コンタクトフォーム（Ajax対応）
- パフォーマンス最適化

## インストール方法

### WP Pusherを使用（推奨）

1. WordPressにWP Pusherプラグインをインストール
2. WP Pusherの設定でこのリポジトリを接続
3. テーマを有効化

### 手動インストール

1. `kanucard-lp-theme`フォルダをZIP化
2. WordPress管理画面 > 外観 > テーマ > 新規追加 > テーマのアップロード
3. ZIPファイルをアップロードして有効化

## カスタマイズ

WordPress管理画面 > 外観 > カスタマイズ から以下の項目を編集できます：

- ヒーローセクションのタイトル
- ヒーローセクションのサブタイトル
- CTAボタンのテキストとURL
- カスタムロゴ
- ナビゲーションメニュー

## 技術スタック

- PHP 7.4+
- WordPress 5.0+
- jQuery
- AOS (Animate On Scroll)
- Font Awesome 6

## ディレクトリ構造

```
kanucard-lp-theme/
├── assets/
│   ├── css/
│   │   └── main.css
│   ├── js/
│   │   └── main.js
│   └── images/
│       └── services-placeholder.svg
├── inc/
├── template-parts/
│   └── content-landing.php
├── functions.php
├── header.php
├── footer.php
├── index.php
├── style.css
└── screenshot.png
```

## ライセンス

GPL v2 or later

## 作成者

Kanucard Team