# ECサイトポートフォリオ

## 概要
LaravelとDockerで作成したECサイトです。
商品の閲覧、カート機能、Stripe決済など、実際のECサイトに必要な基本機能を実装しています。
また、メール通知やレスポンシブ対応など、実務を想定した機能も備えています。

## 実装機能
### 認証・ユーザー管理
- ユーザー登録
- ログイン/ログアウト
- パスワードリセット

### 商品関連
- 商品一覧表示
- 商品詳細表示
- 画像アップロード

### 購入フロー
- カート機能（追加/編集/削除）
- Stripe決済処理
- 注文完了画面表示
- 注文完了メール送信

### その他
- レスポンシブデザイン
- エラーハンドリング
- トランザクション処理

## 使用技術
### バックエンド
- PHP 8.2
- Laravel 11.x
- MySQL 8.0

### フロントエンド
- TailwindCSS
- Alpine.js

### インフラ・その他
- Docker/Docker Compose
- Stripe API（決済処理）
- SMTP（メール送信）
- Git/GitHub（バージョン管理）

## 工夫した点
- Stripeを使用した決済機能の実装
- メール通知による自動化
- トランザクション処理による安全な注文処理
- レスポンシブデザインによるマルチデバイス対応

## 今後の改善点
- 管理者機能の追加
- 商品検索機能の強化
- レビュー機能の実装

## 環境構築
```bash
# リポジトリのクローン
git clone https://github.com/coke-33/laravel-ec-portfolio.git
cd laravel-ec-portfolio

# Dockerコンテナの起動
docker compose up -d

# 依存関係のインストール
docker compose exec app composer install
docker compose exec app npm install
docker compose exec app npm run dev

# 環境設定
cp .env.example .env
docker compose exec app php artisan key:generate

# データベースのセットアップ
docker compose exec app php artisan migrate --seed
