<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DM3treeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                 $x = [
          
                    'name' => 'root',
                     'user_id' => 0,
                     'balance' => 0,
                     'logs' => '0',   
               
        ];
        
        \App\Models\DM3tree::create($x);
    }
}
