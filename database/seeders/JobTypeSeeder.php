<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobType;
class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = [
            'Full-time',
            'Part-time',
            'Permanent',
            'Fixed term',
            'Temporary',
            'OJT(On the Job Training)',
            'Fresh Graduate'
        ];

        foreach ($types as $type) {
            JobType::create(['name' => $type]);
        }
}
}
