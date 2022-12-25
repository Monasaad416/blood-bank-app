<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governorates = [
           "Cairo",
            "Giza",
            "Alexandria",
            "Dakahlia",
            "Red Sea",
            "Beheira",
            "Fayoum",
            "Gharbiya",
            "Ismailia",
            "Menofia",
            "Minya",
            "Qaliubiya",
            "New Valley",
            "Suez",
            "Aswan",
            "Assiut",
            "Beni Suef",
            "Port Said",
            "Damietta",
            "Sharkia",
            "South Sinai",
            "Kafr Al sheikh",
            "Matrouh",
            "Luxor",
            "Qena",
            "North Sinai",
            "Sohag"
        ];


        foreach ($governorates as $governorate) {
            Governorate::create(
                [
                    'name' => $governorate,
                ],
            );
        }

    }
}
