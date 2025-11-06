<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProspectStatusSeeder::class,
            ProspectLocationSeeder::class,
            ProspectIndustrySeeder::class,
            InitialSequencesSeeder::class,
            InitialProspectSeeder::class,
            InitialSequencePointMessagesSeeder::class,
            InitialDummyUserSeeder::class,
        ]);
    
        // Verificar si el archivo del seeder existe y ejecutarlo si es así
        if (file_exists(database_path('seeders/InitialUserSeeder.php'))) {
            $this->call(InitialUserSeeder::class);
        }
    }    
}
