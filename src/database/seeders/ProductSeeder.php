<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => '高級腕時計',
                'description' => '洗練されたデザインと高い精度を兼ね備えた腕時計です。',
                'price' => 25800,
                'stock' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'レザーバッグ',
                'description' => '上質な本革を使用したハンドメイドのバッグです。',
                'price' => 15800,
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'ワイヤレスイヤホン',
                'description' => '高音質で快適な装着感のワイヤレスイヤホンです。',
                'price' => 12800,
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'スマートウォッチ',
                'description' => '健康管理と通知機能を備えたスマートウォッチです。',
                'price' => 18800,
                'stock' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'カメラレンズ',
                'description' => 'プロ仕様の高性能カメラレンズです。',
                'price' => 45800,
                'stock' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}