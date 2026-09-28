<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('food')->insert([
            [
                'name' => 'Mie ayam',
                'category' => 'makanan',
                'price' => 15000,
                'description' => 'makanan sehari-hari orang indonesia',
                'image' => NULL,
                'created_at' => now() ,
                'updated_at' => now(),
            ],
            [
                'name' => 'ayam geprek',
                'category' => 'makanan',
                'price' => 15000,
                'description' => 'ayam goreng dengan sambal diatasnya lalu digeperk',
                'image' => NULL,
                'created_at' => now() ,
                'updated_at' => now(),
            ],
            [
                'name' => 'Es Kelapa Muda',
                'category' => 'minuman',
                'price' => 6000,
                'description' => 'es kelapa Muda segar',
                'image' => NULL,
                'created_at' => now() ,
                'updated_at' => now(),
            ],
            [
                'name' => 'Nabati',
                'category' => 'cemilan',
                'price' => 2500,
                'description' => 'Wafer Renyah dimulut',
                'image' => NULL,
                'created_at' => now() ,
                'updated_at' => now(),
            ],
            [
                'name' => 'Nasi goreng',
                'category' => 'makanan',
                'price' => 15000,
                'description' => 'Makanan terenak no 5 didunia',
                'image' => NULL,
                'created_at' => now() ,
                'updated_at' => now(),
            ],
        ]);
    }
}
