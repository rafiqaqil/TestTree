<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DM5treeSeeder extends Seeder
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
               'DM3_CREDITED' => '1',
               
        ];
        
        \App\Models\DM5tree::create($x);
    }
}
