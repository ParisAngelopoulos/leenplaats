<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $user = fn ($email) => User::where('email', $email)->value('id');
        $product = fn ($name) => Product::where('name', $name)->value('id');

        // Een paar reserveringen, verdeeld over vorige, deze en volgende week
        $reservations = [
            ['Boormachine', 'sanne@voorbeeld.nl', -7, -5],
            ['Partytent', 'paris@voorbeeld.nl', 2, 4],
            ['Ladder', 'daan@voorbeeld.nl', 0, 1],
            ['Spelcomputer', 'lisa@voorbeeld.nl', -1, 6],
            ['Hogedrukreiniger', 'paris@voorbeeld.nl', 8, 9],
            ['Kampeertent', 'sanne@voorbeeld.nl', 14, 21],
        ];

        foreach ($reservations as [$name, $email, $from, $to]) {
            Reservation::create([
                'product_id' => $product($name),
                'user_id' => $user($email),
                'start_date' => now()->startOfDay()->addDays($from),
                'end_date' => now()->startOfDay()->addDays($to),
            ]);
        }
    }
}
