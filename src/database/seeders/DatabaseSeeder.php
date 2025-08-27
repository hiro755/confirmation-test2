<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $products = [
            ['name' => 'キウイ', 'price' => 800, 'image' => 'kiwi.png'],
            ['name' => 'ストロベリー', 'price' => 1200, 'image' => 'strawberry.png'],
            ['name' => 'オレンジ', 'price' => 850, 'image' => 'orange.png'],
            ['name' => 'スイカ', 'price' => 700, 'image' => 'watermelon.png'],
            ['name' => 'ピーチ', 'price' => 1000, 'image' => 'peach.png'],
            ['name' => 'シャインマスカット', 'price' => 1400, 'image' => 'muscat.png'],
            ['name' => 'バナナ', 'price' => 600, 'image' => 'banana.png'],
            ['name' => 'パイナップル', 'price' => 800, 'image' => 'pineapple.png'],
            ['name' => 'ブドウ', 'price' => 1100, 'image' => 'grapes.png'],
            ['name' => 'メロン', 'price' => 900, 'image' => 'melon.png'],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'image_path' => 'images/products/' . $product['image'],
                'description' => $faker->sentence(),
            ]);
        }
    }
}