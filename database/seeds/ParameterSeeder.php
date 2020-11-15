<?php

use App\Models\Parameter;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['min_support' => 1, 'min_confidence' => 1],
            ['min_support' => 2, 'min_confidence' => 2],
            ['min_support' => 3, 'min_confidence' => 3],
            ['min_support' => 4, 'min_confidence' => 4],
            ['min_support' => 5, 'min_confidence' => 5],
            ['min_support' => 6, 'min_confidence' => 6],
        ];
        foreach ($data as $params) {
            Parameter::create($params);
        }
    }
}
