<?php

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
        $this->call(UserTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(PropertyTableSeeder::class);
        $this->call(PropertyTypeTableSeeder::class);
        $this->call(WarehouseTableSeeder::class);
    }
}
