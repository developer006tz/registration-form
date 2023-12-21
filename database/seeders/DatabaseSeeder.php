<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Regions;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user


        $regionData = [
            ['id' => 3, 'name' => 'Dar es salaam'],
            ['id' => 4, 'name' => 'Morogoro']
        ];

        foreach ($regionData as $region) {
            Regions::create($region);
        }

        $districtData = [
            ['id' => 1, 'name' => 'Ilala', 'regions_id' => 3],
            ['id' => 2, 'name' => 'Kinondoni', 'regions_id' => 3],
            ['id' => 4, 'name' => 'Kilosa', 'regions_id' => 4],
            ['id' => 5, 'name' => 'Mvomero', 'regions_id' => 4]
        ];



        foreach ($districtData as $district) {
            District::create($district);
        }

        $languageData = [
            ['id' => 1, 'name' => 'English'],
            ['id' => 2, 'name' => 'Swahili'],
            ['id' => 3, 'name' => 'French'],
            ['id' => 4, 'name' => 'Other'],

        ];

        foreach ($languageData as $language) {
            \App\Models\Language::create($language);
        }
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'name' => 'LudovicKonyo',
                'email' => 'admin@admin.com',
                'phone' => '255714000000',
                'dob'=>date('Y/m/d'),
                'district_id'=>1,
                'regions_id'=>3,
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);



    }
}
