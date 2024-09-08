<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            "Cairo, Egypt",
            "Alexandria, Egypt",
            "Assiut, Egypt",
            "Aswan, Egypt",
            "Beheira, Egypt",
            "Bani Suef, Egypt",
            "Daqahliya, Egypt",
            "Damietta, Egypt",
            "Fayyoum, Egypt",
            "Gharbiya, Egypt",
            "Giza, Egypt",
            "Ismailia, Egypt",
            "Kafr El Sheikh, Egypt",
            "Luxor, Egypt",
            "Marsa Matrouh, Egypt",
            "Minya, Egypt",
            "Monofiya, Egypt",
            "New Valley, Egypt",
            "North Sinai, Egypt",
            "Port Said, Egypt",
            "Red Sea, Egypt",
            "Sharqiya, Egypt",
            "Sohag, Egypt",
            "South Sinai, Egypt",
            "Suez, Egypt",
            "Tanta, Egypt"
        ];


        foreach ($locations as $location) {
            Location::create(['name' => $location]);
        }
    }
}
