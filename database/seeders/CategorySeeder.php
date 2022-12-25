<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Haematology','Health & Safety','Microbiology','surgery','pediatrics'];
        foreach ($categories as $type) {
            Category::create(
                [
                    'name' => $type,
                ],
            );
        }
    }
}
