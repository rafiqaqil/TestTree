<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
        
        
         DB::table('users')->insert([
             'username' => 'Admin',
            'name' => 'Admin',
            'email' => 'Admin@e-dm5.uk',
             'email_verified_at' => '2000-01-01 00:00:00',
            'password' => Hash::make('Admin12#'),
        ]);
         
         $user = \App\Models\User::find(1);
            $user->profile()->create([
                'name' => $user->username,
            ]);
            
            
          
          
    }
}
