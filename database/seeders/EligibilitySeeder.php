<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EligibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('eligibilities')->insert([
        ['name' => 'Career Service (subprofessional) First level Eligibility'],
        ['name' => 'Career Service (subprofessional) Second level Eligibility'],
        ['name' => 'Career Service (Professional) Second Level Eligibility'],
        ['name' => 'Career Service (Professional) First Level Eligibility'],
        ['name' => 'Mason(MC 11, s. 96 - Cat. III)'],
        ['name' => 'Driver\'s License'],
        ['name' => 'RA 1080'],
        ['name' => 'RA 1080 (Veterinarian)'],
        ['name' => 'Electrician (MC 11, s. 1996-Cat. II)'],
        ['name' => 'Heavy Equipment Operator'],
    ]);
}

}
