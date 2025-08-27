<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $products = [
            ['name' => 'キウイ', 'price' => 800, 'image' => 'kiwi.png'],
            ['name' => 'ストロベリー', 'price' => 1200, 'image' => 'strawberry.png'],
            ['name' => 'オレンジ', 'price' => 850, 'image' => 'orange.png'],
            ['name' => 'スイカ', 'price' => 700, 'image' => 'watermelon.png'],
            ['name' => 'ピーチ', 'price' => 1000, 'image' => 'peach.png'],
            ['name' => 'シャインマスカット', 'price' => 1400, 'image' => 'muscat.png'],
            ['name' => 'バナナ', 'price' => 600, 'image' => 'banana.png'],
            ['name' => 'パイナップル', 'price' => 800, 'image' => 'pineapple.png'],
            ['name' => 'ブドウ', 'price' => 1100, 'image' => 'grape.png'],
            ['name' => 'メロン', 'price' => 900, 'image' => 'melon.png'],
        ];

        $random = collect($products)->random();

        return [
            'name' => $random['name'],
            'price' => $random['price'],
            'image_path' => 'images/products/' . $random['image'],
            'description' => $this->faker->sentence(),
        ];
    }
}