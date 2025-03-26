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
        $sequenceProspection = Sequence::where('code', 'PD-CCC')->first()->id;

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
            [
                'sequence_id' => $sequenceProspection,
                'order' => 1,
                'time_type' => 'dynamic',
                'days_after_start' => 0,
                'message' => '¿Alguna vez has pensado cuánto cuesta realmente tu tiempo? 
Cada hora que pasas resolviendo tareas que no deberías hacer…
Te aleja del foco, del crecimiento y de lo que realmente importa.
Si quieres compartir visión, encantado de conectar.',
                'goal' => 'Solicitud de conexión',
            ],
            [
                'sequence_id' => $sequenceProspection,
                'order' => 2,
                'time_type' => 'dynamic',
                'days_after_start' => 0,
                'message' => 'Gracias por aceptar, {$first_name}.

Trabajo con empresarios y directivos que han tocado techo en su capacidad de entrega.

Les ayudo a recuperar hasta 30h/mes sin perder rentabilidad, ni delegar sin control.

Si te interesa saber cuánto podrías estar perdiendo por hacer tareas que no te necesitan, tengo una herramienta para verlo claro en 2 minutos.',
                'goal' => 'Dar valor antes de pedir nada, sin enviar el link',
            ],
            [
                'sequence_id' => $sequenceProspection,
                'order' => 3,
                'time_type' => 'dynamic',
                'days_after_previous' => 3,
                'message' => 'Hola, {$first_name}.

Me quedé con la duda de si te resonó lo que te compartí.

No intento venderte nada. Solo mostrarte algo que quizás te haga pensar.

Si ahora no es buen momento, lo entiendo. Pero si quieres ver cuánto cuesta cada semana no delegar, dímelo y te paso el acceso.',
                'goal' => 'Follow up 1, si no hay respuesta',
            ],
            [
                'sequence_id' => $sequenceProspection,
                'order' => 4,
                'time_type' => 'dynamic',
                'days_after_previous' => 4,
                'message' => 'Último mensaje por mi parte, {$first_name}, y gracias por llegar hasta aquí.

Solo decirte que muchos empresarios pierden más de 20.000 €/año sin saberlo.

Si en algún momento te preguntas si te está pasando a ti…
aquí estaré.',
                'goal' => 'Follow up 2. Último mensaje, si no hay respuesta',
            ],            
        ];



        foreach ($messages as $data) {
            SequencePoint::create($data);
        }
    }

}
