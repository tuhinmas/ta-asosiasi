<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => "Tuhinmas",
                'email' => "mastuhin33@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('secret'), // password
                'remember_token' => Str::random(10),
                'role_id' => 1,  
            ],[
                'name' => "Tuhinmas",
                'email' => "mastuhin@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'), // password
                'remember_token' => Str::random(10),
                'role_id' => 1, 
            ],[
                'name' => "Mastuhin",
                'email' => "mas@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('--xXx--'), // password
                'remember_token' => Str::random(10),
                'role_id' => 1, 
            ],[
                'name' => "Steve",
                'email' => "Steve@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('steve-xxx'), // password
                'remember_token' => Str::random(10),
                'role_id' => 1, 
            ],[
                'name' => "Agus",
                'email' => "Agus@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('secret'), // password
                'remember_token' => Str::random(10),
                'role_id' => 1, 
            ],[
                'name' => "Admin",
                'email' => "Admin@gmail.com",
                'email_verified_at' => now(),
                'password' => bcrypt('admin'), // password
                'remember_token' => Str::random(10),
                'role_id' => 2, 
            ]
        ];
        foreach($users as $user){
            User::create($user);
        }
    }
}
