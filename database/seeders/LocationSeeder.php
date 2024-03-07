<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiUrl = 'https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json';

        $response = Http::get($apiUrl);
        if ($response->successful()) {
            $locationsData = $response->json();
            foreach ($locationsData as $location) {
                Location::create([
                    'location' => $location['ville']
                ]);
            }

            $this->command->info('Locations seeded successfully.');
        } else {
            $this->command->error('Failed to fetch data from the API.');
        }
    }
}
