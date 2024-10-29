# ECサイトポートフォリオ

## 概要
LaravelとDockerで作成したECサイトです。
商品の閲覧、カート機能、Stripe決済など、実際のECサイトに必要な基本機能を実装しています。

## 機能一覧
- ユーザー認証（登録、ログイン）
- 商品一覧・詳細表示
- カート機能
- 決済機能（Stripe）
- 注文履歴
- メール通知
- レスポンシブ対応

## 使用技術
- PHP 8.2
- Laravel 11.x
- MySQL 8.0
- Docker/Docker Compose
- Stripe API
- TailwindCSS
- Alpine.js

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