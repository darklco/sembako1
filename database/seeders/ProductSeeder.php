<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'beras',
                'description' => 'beras lezat dan bergizi',
                'price' => 89500,
                'stock' => 38,
                'image' => 'beras.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tepung Maizena',
                'description' => 'Tepung Maizena untuk memasak',
                'price' => 25000,
                'stock' => 50,
                'image' => 'maizena.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
