<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectLocation extends Model
{
    use HasFactory;

    protected $table = 'prospect_locations';

    protected $fillable = ['name', 'code'];

    // Relationship with Prospects (One to Many)
    // Relación con Prospects (Uno a Muchos)
    public function prospects()
    {
        return $this->hasMany(Prospect::class, 'location_id');
    }
}
