<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    protected $fillable = ['prospect_id', 'title', 'description'];

    // Relationship with Prospects (One to Many)
    // Relación con Prospects (Uno a Muchos)
    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }
}
