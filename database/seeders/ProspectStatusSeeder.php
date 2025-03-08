<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProspectStatus;
use Illuminate\Support\Facades\DB;

class ProspectStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['code' => 'NC', 'name' => 'No contactado', 'description' => 'Prospecto al que aún no se ha contactado.'],
            ['code' => 'CI', 'name' => 'Contacto inicial', 'description' => 'Prospecto al que se le ha enviado primer contacto sin respuesta.'],
            ['code' => 'NI', 'name' => 'No interesado', 'description' => ' Prospecto que no muestra interés o ha pedido no ser contactado.'],
            ['code' => 'EC', 'name' => 'En conversación', 'description' => 'Prospecto interesado con el que mantenemos conversación'],
            ['code' => 'NCu', 'name' => 'No cualificado', 'description' => 'Prospecto interesado que no cualifica.'],
            ['code' => 'CL', 'name' => 'Cliente', 'description' => 'Prospect converted into a new client.'],
        ];

        foreach ($statuses as $status) {
            ProspectStatus::updateOrCreate(['code' => $status['code']], $status);
        }
    }
}
