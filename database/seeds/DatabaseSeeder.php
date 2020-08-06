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
        $this->call(CodeGroupSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(JavoxirSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
    }
}
