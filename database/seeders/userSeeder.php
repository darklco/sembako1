<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->insert([
            'name' => 'sembakoku',
            'email' => 'sembakoku@gmail.com',
            'password' => Hash::make('sembakoku'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
