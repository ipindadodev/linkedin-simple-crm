<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectIndustry extends Model
{
    use HasFactory;

    protected $table = 'prospect_industries';

    protected $fillable = ['name'];

    // Relationship with Prospects (One to Many)
    // Relación con Prospects (Uno a Muchos)
    public function prospects()
    {
        return $this->hasMany(Prospect::class, 'industry_id');
    }
}
