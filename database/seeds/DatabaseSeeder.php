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
        $this->call(ParameterSeeder::class);
        // $this->call(OrderofItemSeeder::class);
        $this->call(H_1Seeder::class);
        $this->call(H_2Seeder::class);
    }
}
