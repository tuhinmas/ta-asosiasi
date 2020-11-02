<?php

use App\Models\Diskon;
use Illuminate\Database\Seeder;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diskon = [
            ["product_id" => "528832a8-fc9f-4ae6-87b3-7211f0288123", "diskon"=>"5","ppn"=>"10"],
            ["product_id" => "f1e3c4fe-27b5-41fa-b175-1d5e07284086", "diskon"=>"5","ppn"=>"10"],
            ["product_id" => "2a9531e3-bcde-4750-9180-99b249ab335e", "diskon"=>"5","ppn"=>"10"],
            ["product_id" => "395ab1b8-de38-4d7d-84fc-249ac8ec168e", "diskon"=>"5","ppn"=>"10"],
            ["product_id" => "9ee46b6f-6d7d-443e-a409-412ce7152b1a", "diskon"=>"5","ppn"=>"10"],
        ];
        foreach($diskon as $diskons){
            Diskon::create($diskons);
        }
    }
}
