<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sequence;

class InitialSequencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sequences = [
            ['CA-IN', 'Calentamiento', 'Campaña de calentamiento: Ser visible por el prospecto amtes de conectar'],
            ['PD-CCC', 'Prospección directa', 'Campaña intensiva: Conexión - Cualificación - Cierre'],
            ['EE-EC', 'Enriquecimiento', 'Campaña de enriquecimiento y educación: Educar y cualificar'],
            ['MA-NI', 'Mantenimiento', 'Campaña de mantenimiento dedicada a los prospectos no interesados en este momento']
        ];

        foreach ($sequences as $sequence) {
            Sequence::create([
                'code' => $sequence[0],
                'name' => $sequence[1],
                'description' => $sequence[2],
            ]);
        }
    }
}
