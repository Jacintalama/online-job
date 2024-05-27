<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaryGradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('salary_grades')->insert([
            ['grade' => 1, 'amount' => 13000],
            ['grade' => 2, 'amount' => 13819],
            ['grade' => 3, 'amount' => 14678],
            ['grade' => 4, 'amount' => 15586],
            ['grade' => 5, 'amount' => 16543],
            ['grade' => 6, 'amount' => 17553],
            ['grade' => 7, 'amount' => 18620],
            ['grade' => 8, 'amount' => 19744],
            ['grade' => 9, 'amount' => 21211],
            ['grade' => 10, 'amount' => 23176],
            ['grade' => 11, 'amount' => 27000],
            ['grade' => 12, 'amount' => 29165],
            ['grade' => 13, 'amount' => 31320],
            ['grade' => 14, 'amount' => 33843],
            ['grade' => 15, 'amount' => 36619],
            ['grade' => 16, 'amount' => 39672],
            ['grade' => 17, 'amount' => 43030],
            ['grade' => 18, 'amount' => 46725],
            ['grade' => 19, 'amount' => 51357],
            ['grade' => 20, 'amount' => 57347],
            ['grade' => 21, 'amount' => 63997],
            ['grade' => 22, 'amount' => 71511],
            ['grade' => 23, 'amount' => 80003],
            ['grade' => 24, 'amount' => 90078],
            ['grade' => 25, 'amount' => 102690],
            ['grade' => 26, 'amount' => 116040],
            ['grade' => 27, 'amount' => 131124],
            ['grade' => 28, 'amount' => 148171],
            ['grade' => 29, 'amount' => 167432],
            ['grade' => 30, 'amount' => 189199],
            ['grade' => 31, 'amount' => 278434],
            ['grade' => 32, 'amount' => 331954],
            ['grade' => 33, 'amount' => 419144],
        ]);
    }

}
