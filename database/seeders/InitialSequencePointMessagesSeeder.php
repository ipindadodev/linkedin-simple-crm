<?php

namespace Database\Seeders;

use App\Models\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SequencePoint;
use Illuminate\Support\Facades\DB;

class InitialSequencePointMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sequenceId = Sequence::where('code', 'CA-IN')->first()->id;

        $messages = [
            [
                'sequence_id' => $sequenceId,
                'order' => 1,
                'time_type' => 'dynamic',
                'days_after_start' => 0,
                'message' => 'Responder a publicación y reaccionar 1',
                'goal' => 'Ganar visibilidad frente al prospecto',
            ],
            [
                'sequence_id' => $sequenceId,
                'order' => 2,
                'time_type' => 'dynamic',
                'days_after_previous' => 2,
                'message' => 'Responder a publicación y reaccionar 2',
                'goal' => 'Ganar visibilidad frente al prospecto',
            ],
            [
                'sequence_id' => $sequenceId,
                'order' => 3,
                'time_type' => 'dynamic',
                'days_after_previous' => 1,
                'message' => 'Responder a publicación y reaccionar 3',
                'goal' => 'Ganar visibilidad frente al prospecto',
            ],
            [
                'sequence_id' => $sequenceId,
                'order' => 4,
                'time_type' => 'dynamic',
                'days_after_previous' => 4,
                'message' => 'Responder a publicación y reaccionar 3',
                'goal' => 'Ganar visibilidad frente al prospecto',
            ],
            [
                'sequence_id' => $sequenceId,
                'order' => 5,
                'time_type' => 'dynamic',
                'days_after_previous' => 2,
                'message' => 'Responder a publicación y reaccionar 4',
                'goal' => 'Ganar visibilidad frente al prospecto',
            ],
            [
                'sequence_id' => $sequenceId,
                'order' => 6,
                'time_type' => 'dynamic',
                'days_after_previous' => 3,
                'message' => 'Responder a publicación y reaccionar 5',
                'goal' => 'Ganar visibilidad frente al prospecto',
            ],
        ];

        foreach ($messages as $data) {
            SequencePoint::create($data);
        }
    }

}
