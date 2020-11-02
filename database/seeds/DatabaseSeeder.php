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
        // $this->call(UserTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(TransaksiDetailSeeder::class);
    }
}
