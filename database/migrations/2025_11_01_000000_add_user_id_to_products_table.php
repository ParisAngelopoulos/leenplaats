<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Who offers the product (the person you borrow it from)
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->index();
        });

        // A database that already has the example products: give them their owner too
        $owners = ['Boormachine' => 'daan', 'Grasmaaier' => 'paris', 'Ladder' => 'lisa', 'Partytent' => 'sanne',
            'Hogedrukreiniger' => 'daan', 'Kampeertent' => 'lisa', 'Spelcomputer' => 'paris', 'Aanhanger' => 'sanne'];
        foreach ($owners as $product => $owner) {
            $userId = DB::table('users')->where('email', $owner . '@voorbeeld.nl')->value('id');
            if ($userId) {
                DB::table('products')->where('name', $product)->whereNull('user_id')->update(['user_id' => $userId]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
