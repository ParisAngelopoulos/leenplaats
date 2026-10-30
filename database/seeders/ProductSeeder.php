<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Boormachine', 'description' => 'Accuboormachine met twee accu\'s en een set boortjes.', 'price' => 7.50],
            ['name' => 'Grasmaaier', 'description' => 'Elektrische grasmaaier, ideaal voor een kleine tuin.', 'price' => 12.00],
            ['name' => 'Ladder', 'description' => 'Aluminium reformladder van 3 meter.', 'price' => 5.00],
            ['name' => 'Partytent', 'description' => 'Partytent van 3 x 6 meter, opzetten in 15 minuten.', 'price' => 25.00],
            ['name' => 'Hogedrukreiniger', 'description' => 'Voor het terras, de auto of de fiets.', 'price' => 10.00],
            ['name' => 'Kampeertent', 'description' => 'Vierpersoonstent met voortent.', 'price' => 15.00],
            ['name' => 'Spelcomputer', 'description' => 'Spelcomputer met twee controllers en drie spellen.', 'price' => 8.00, 'is_available' => false],
            ['name' => 'Aanhanger', 'description' => 'Bakwagen voor achter de auto, laadvermogen 750 kg.', 'price' => 20.00],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
