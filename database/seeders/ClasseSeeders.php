<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'label' => 'CI',
                'level_id' => Level::where('label', 'Elémentaire')->first()->id
            ],
            [
                'label' => 'CP',
                'level_id' => Level::where('label', 'Elémentaire')->first()->id
            ],
            [
                'label' => 'CE1',
                'level_id' => Level::where('label', 'Elémentaire')->first()->id
            ],
            [
                'label' => '6e',
                'level_id' => Level::where('label', 'Moyen')->first()->id
            ],
        ];

        Classe::insert($classes);
    }
}
