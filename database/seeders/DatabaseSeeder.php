<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([//This is the way
            UserSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            StatusSeeder::class,
            SaleSeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
            CategoryProductSeeder::class,
            ProductSaleSeeder::class,
            RoleUserSeeder::class,
        ]);
    }
}
