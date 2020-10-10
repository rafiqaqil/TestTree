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
            [
                'category_name' => 'amirul',
                    'children' => [
                        [    
                            'category_name' => 'saidkin',
                            'children' => [
                                    ['category_name' => 'nabil'],
                                    ['category_name' => 'najib'],
                                    ['category_name' => 'amir'],
                            ],
                        ],
                        [    
                            'category_name' => 'senah',
                                'children' => [
                                    ['category_name' => 'ali'],
                                    ['category_name' => 'abu'],
                                    ['category_name' => 'ahmad'],
                            ],
                        ],
                    ],
                ],
                [
                    'category_name' => 'rafiq',
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
                ],
        ];
        foreach($shops as $shop)
        {
            \App\Models\Shop::create($shop);
        }
    }
}
