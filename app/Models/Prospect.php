<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'second_last_name',
        'linkedin_url',
        'location_id',
        'status_id',
        'industry_id',
    ];

    // Relación con ProspectStatus (Uno a Uno)
    public function status()
    {
        return $this->belongsTo(ProspectStatus::class, 'status_id');
    }

    // Relación con ProspectLocation (Uno a Uno)
    public function location()
    {
        return $this->belongsTo(ProspectLocation::class, 'location_id');
    }

    // Relación con ProspectIndustry (Uno a Uno)
    public function industry()
    {
        return $this->belongsTo(ProspectIndustry::class, 'industry_id');
    }

    // Relación con Interactions (Uno a Muchos)
    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    // Relación con Sequences (Muchos a Muchos)
    public function sequences()
    {
        return $this->belongsToMany(Sequence::class, 'contact_sequences')
                    ->withPivot('included_at')
                    ->withTimestamps();
    }
}