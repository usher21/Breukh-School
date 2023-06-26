<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'label' => "Elémentaire",
            ],
            [
                'label' => 'Moyen'
            ],
            [
                'label' => 'Secondaire'
            ]
        ];

        Level::insert($levels);
    }
}
