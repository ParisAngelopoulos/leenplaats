<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Boormachine',
            'description' => 'Sterke boormachine voor klusjes',
            'price' => 25.00,
            'latitude' => 52.370216,
            'longitude' => 4.895168
        ]);

        Product::create([
            'name' => 'Grasmaaier',
            'description' => 'Elektrische grasmaaier',
            'price' => 35.00,
            'latitude' => 52.3667,
            'longitude' => 4.8945
        ]);

        Product::create([
            'name' => 'Steiger',
            'description' => 'Handige steiger voor schilderwerken',
            'price' => 50.00,
            'latitude' => 52.379189,
            'longitude' => 4.899431
        ]);
    }
}
