<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $sell_price = random_int(2, 50);
            \App\Models\Product::create([
                'name_en' => strtolower(Str::random(10)),
                'name_ar' => strtolower(Str::random(10)),
                'code' => strtolower(Str::random(10)),
                'quantity' => random_int(2, 50),
                'color_en' => strtolower(Str::random(10)),
                'color_ar' => strtolower(Str::random(10)),
                'sell_price' => $sell_price,
                'discount_price' => $sell_price - 1,
                'short_descp_en' => strtolower(Str::random(20)),
                'short_descp_ar' => strtolower(Str::random(20)),
                'long_descp_en' => strtolower(Str::random(100)),
                'long_descp_ar' => strtolower(Str::random(100)),
                'thumbnail' => '',
                'special_offer' => 0,
                'brand' => strtolower(Str::random(10)),
                'category_id' => 4,
                'subcategory_id' => 8
            ]);
        }
    }
}
