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
            ['code' => 'NC', 'name' => 'No contactado', 'description' => 'Prospecto al que aún no se ha contactado.', 'color' => '#6b7280'], // Gris
            ['code' => 'CI', 'name' => 'Contacto inicial', 'description' => 'Prospecto al que se le ha enviado primer contacto sin respuesta.', 'color' => '#2563eb'], // Azul
            ['code' => 'NI', 'name' => 'No interesado', 'description' => 'Prospecto que no muestra interés o ha pedido no ser contactado.', 'color' => '#dc2626'], // Rojo
            ['code' => 'EC', 'name' => 'En conversación', 'description' => 'Prospecto interesado con el que mantenemos conversación.', 'color' => '#fbbf24'], // Amarillo
            ['code' => 'NCu', 'name' => 'No cualificado', 'description' => 'Prospecto interesado que no cualifica.', 'color' => '#9333ea'], // Morado
            ['code' => 'CL', 'name' => 'Cliente', 'description' => 'Prospecto que ha pasado a ser cliente.', 'color' => '#16a34a'], // Verde
        ];

        foreach ($statuses as $status) {
            ProspectStatus::updateOrCreate(['code' => $status['code']], $status);
        }
    }
}
