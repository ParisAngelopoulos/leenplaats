<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['owner' => 'daan', 'name' => 'Boormachine', 'description' => 'Accuboormachine met twee accu\'s en een set boortjes.', 'price' => 7.50],
            ['owner' => 'paris', 'name' => 'Grasmaaier', 'description' => 'Elektrische grasmaaier, ideaal voor een kleine tuin.', 'price' => 12.00],
            ['owner' => 'lisa', 'name' => 'Ladder', 'description' => 'Aluminium reformladder van 3 meter.', 'price' => 5.00],
            ['owner' => 'sanne', 'name' => 'Partytent', 'description' => 'Partytent van 3 x 6 meter, opzetten in 15 minuten.', 'price' => 25.00],
            ['owner' => 'daan', 'name' => 'Hogedrukreiniger', 'description' => 'Voor het terras, de auto of de fiets.', 'price' => 10.00],
            ['owner' => 'lisa', 'name' => 'Kampeertent', 'description' => 'Vierpersoonstent met voortent.', 'price' => 15.00],
            ['owner' => 'paris', 'name' => 'Spelcomputer', 'description' => 'Spelcomputer met twee controllers en drie spellen.', 'price' => 8.00, 'is_available' => false],
            ['owner' => 'sanne', 'name' => 'Aanhanger', 'description' => 'Bakwagen voor achter de auto, laadvermogen 750 kg.', 'price' => 20.00],
        ];

        // Each product is offered by one of the test users
        foreach ($products as $product) {
            $owner = User::where('email', $product['owner'] . '@voorbeeld.nl')->value('id');
            unset($product['owner']);
            Product::create($product + ['user_id' => $owner]);
        }
    }
}
