<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            ["id" => 1,"name" => "Kasir"],
            ["id" => 2,"name" => "Owner"]
        ];
        foreach($role as $roles){
            Role::create($roles);
        }
    }
}
