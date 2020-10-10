<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = [
          
                
                    ['category_name' => 'rafiq',
                        'children' => [
                        [
                            'category_name' => 'mohamad',
                            'children' => [
                                ['category_name' => 'muhaimin'],
                                ['category_name' => 'muklis'],
                            ],
                        ],
                        [
                            'category_name' => 'barr',
                            'children' => [
                                ['category_name' => 'noh'],
                                ['category_name' => 'conor'],
                                ['category_name' => 'putin'],
                            ],
                        ],
                    ],
              ]  
        ];
        foreach($shops as $shop)
        {
            \App\Models\Shop::create($shop);
        }
    }
}
