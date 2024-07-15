<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usaState = [
            "AL" => "Alabama",
            "AK" => "Alaska",
            "AZ" => "Arizona",
            "AR" => "Arkansas",
            "CA" => "California",
        ];
        $country = [
            ['code' => 'AF', 'name' => 'Afghanistan', 'states' => null],
            ['code' => 'UZ', 'name' => 'Uzbekistan', 'states' => null],
            ['code' => 'DZ', 'name' => 'Algeria', 'states' => null],
            ['code' => 'AD', 'name' => 'Andorra', 'states' => null],
            ['code' => 'TM', 'name' => 'Turkmenistan', 'states' => null],
            ['code' => 'AI', 'name' => 'Anguilla', 'states' => null],
            ['code' => 'EA', 'name' => 'Eritrea', 'states' => null],
        ];
        Country::insert($country);
    }
}
