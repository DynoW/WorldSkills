<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Venue::withoutTimestamps(function () {
            Venue::create([
                'id' => '1',
                'name' => 'Stade de France',
                'location' => 'Saint-Denis'
            ]);

            Venue::create([
                'id' => '2',
                'name' => 'Arena Bercy',
                'location' => 'París'
            ]);

            Venue::create([
                'id' => '3',
                'name' => 'Roland Garros',
                'location' => 'París'
            ]);

            Venue::create([
                'id' => '4',
                'name' => 'Vélodrome National',
                'location' => 'Saint-Quentin'
            ]);

            Venue::create([
                'id' => '5',
                'name' => 'Grand Palais',
                'location' => 'París'
            ]);
        });
    }
}
