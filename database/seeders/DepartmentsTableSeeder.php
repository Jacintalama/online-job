<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('departments')->insert([
        ['name' => 'Office of the Building Official'],
        ['name' => 'City Mayor\'s Office'],
        ['name' => 'City Accountant\'s Office'],
        ['name' => 'City Administrator\'s Office'],
        ['name' => 'City Agriculturist\'s Office'],
        ['name' => 'City Assessor\'s Office'],
        ['name' => 'City Budget Office'],
        ['name' => 'City Engineer\'s Office'],
        ['name' => 'City Envi & Natural Resources'],
        ['name' => 'City General Services Office'],
        ['name' => 'City Health Office'],
        ['name' => 'City Housing & Land Mgt Office'],
        ['name' => 'City Internal Audit Services'],
        ['name' => 'City Legal Office'],
        ['name' => 'City Planning And Devt Office'],
        ['name' => 'City Population Mgt Office'],
        ['name' => 'City Public Library'],
        ['name' => 'City Social Welfare & Devt'],
        ['name' => 'City Treasurer\'s Office'],
        ['name' => 'City Veterinarian\'s Office'],
        ['name' => 'Doctor Jorge P. Royeca Hospital'],
        ['name' => 'Local Civil Registrar\'s Office'],
        ['name' => 'Public Safety Office'],
        ['name' => 'Sangguniang Panlunsod'],
        ['name' => 'Strategic Performance|Compliance'],
        ['name' => 'Waste Management Office'],
    ]);
}
}
