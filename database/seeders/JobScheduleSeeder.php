<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobSchedule;
class JobScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $schedules = [
            'Flextime',
            '8 hours shift',
            '10 hours shift',
            '12 hours shift',
            'Shift system',
            'Day shift',
            'Afternoon shift',
            'Evening shift',
            'Monday to Friday',
            'Weekends',
            'Overtime'
        ];

        foreach ($schedules as $schedule) {
            JobSchedule::create(['name' => $schedule]);
        }
    }
}
