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
            ['min_support' => 0.01, 'min_confidence' => 25],
            ['min_support' => 0.02, 'min_confidence' => 30],
            ['min_support' => 0.03, 'min_confidence' => 35],
            ['min_support' => 0.04, 'min_confidence' => 40],
            ['min_support' => 0.05, 'min_confidence' => 45],
            ['min_support' => 0.06, 'min_confidence' => 50],
            ['min_support' => 0.07, 'min_confidence' => 60],
        ];
        foreach ($data as $params) {
            Parameter::create($params);
        }
    }
}
