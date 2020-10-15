<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShopTableSeeder::class);
        $this->call(SponsorTableSeeder::class);
         $this->call(DM3treeSeeder::class);
         $this->call(DM5treeSeeder::class);
         
    }
}
