<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents(storage_path('app/seeds/philippine_provinces_cities_municipalities_and_barangays_2019v2.json'));

        if (!$jsonData) {
            // Handle error when file not found or read fails
            return;
        }

        $data = json_decode($jsonData, true);

        DB::transaction(function () use ($data) {
            foreach ($data as $regionCode => $regionData) {
                // Ensure expected keys exist
                if (!isset($regionData['region_name'], $regionData['province_list'])) {
                    // Optionally: Log error or handle
                    continue;
                }

                $regionId = DB::table('regions')->insertGetId(['name' => $regionData['region_name']]);

                foreach ($regionData['province_list'] as $provinceName => $province) {
                    // Ensure expected keys exist
                    if (!isset($province['municipality_list'])) {
                        // Optionally: Log error or handle
                        continue;
                    }

                    $provinceId = DB::table('provinces')->insertGetId([
                        'name' => $provinceName,
                        'region_id' => $regionId,
                    ]);

                    foreach ($province['municipality_list'] as $municipalityName => $municipality) {
                        // Ensure expected keys exist
                        if (!isset($municipality['barangay_list'])) {
                            // Optionally: Log error or handle
                            continue;
                        }

                        $municipalityId = DB::table('municipalities')->insertGetId([
                            'name' => $municipalityName,
                            'province_id' => $provinceId,
                        ]);

                        $barangays = array_map(function ($barangayName) use ($municipalityId) {
                            return [
                                'name' => $barangayName,
                                'municipality_id' => $municipalityId,
                            ];
                        }, $municipality['barangay_list']);

                        DB::table('barangays')->insert($barangays);
                    }
                }
            }
        });
    }

}
