<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectStatus extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description'];

    // Relationship with Prospects (One to Many)
    // Relación con Prospects (Uno a Muchos)
    public function prospects()
    {
        return $this->hasMany(Prospect::class, 'status_id');
    }
}