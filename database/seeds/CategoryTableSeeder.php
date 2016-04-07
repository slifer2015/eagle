<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            ['name'=>'برنامه نویسی تحت وب',
            'children'=>[
                ['name'=>'لاراول'],
                ['name'=>'جاوا اسکریپت'],
                ['name'=>'پایتون'],
                ['name'=>'زند']
            ]
            ],
            ['name'=>'برنامه نویسی موبایل',
                'children'=>[
                    ['name'=>'اندروید'],
                    ['name'=>'اپل']
                ]
            ]
        ];
        Category::buildTree($categories);
    }
}
