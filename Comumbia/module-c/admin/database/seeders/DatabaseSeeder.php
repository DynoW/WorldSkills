<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin')
        ]);

        $this->call(VenueSeeder::class);

        // Testing
        Event::create([
            'name' => 'meci',
            'date' => '2024-1-1',
            'venue_id' => 1
        ]);

        Participant::create([
            'fullname' => 'test',
            'email' => 'test@gmail.com',
            'phone' => '07',
            'event_id' => 1
        ]);
    }
}
