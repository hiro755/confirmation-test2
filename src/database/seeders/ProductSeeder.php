<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        Product::query()->insert([
            ['name'=>'キウイ',           'price'=>800,  'image_path'=>'products/kiwi.jpg',       'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'ストロベリー',     'price'=>1200, 'image_path'=>'products/strawberry.jpg', 'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'オレンジ',         'price'=>850,  'image_path'=>'products/orange.jpg',     'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'スイカ',           'price'=>700,  'image_path'=>'products/watermelon.jpg', 'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'ピーチ',           'price'=>1000, 'image_path'=>'products/peach.jpg',      'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'シャインマスカット','price'=>1400,'image_path'=>'products/grape.jpg',      'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'メロン',            'price'=>900, 'image_path'=>'products/melon.jpg',       'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'パイナップル',       'price'=>800,  'image_path'=>'products/pineapple.jpg',  'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'ブドウ',             'price'=>1100, 'image_path'=>'products/grape2.jpg',      'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'バナナ',             'price'=>600,  'image_path'=>'products/banana.jpg',      'created_at'=>$now, 'updated_at'=>$now],
        ]);
    }
}
