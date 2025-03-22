<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prospect;
use App\Models\ProspectIndustry;
use App\Models\ProspectStatus;
use App\Models\ProspectLocation;

class InitialProspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prospect = new Prospect();
        $prospect->first_name = 'Ignacio';
        $prospect->last_name = 'Pindado';
        $prospect->second_last_name = 'Letamendía';
        $prospect->email = 'ignacio.pindado@brillaestrategia.com';
        $prospect->phone = '';
        $prospect->linkedin_url = 'https://www.linkedin.com/in/ipindado/';
        $prospect->company = 'Brilla Estrategia';
        $prospect->status_id = ProspectStatus::where('code', 'NC')->first()->id;
        $prospect->location_id = ProspectLocation::where('name', 'Segovia')->first()->id;
        $prospect->industry_id = ProspectIndustry::where('id', '45')->first()->id;
        $prospect->save();
    }
}
