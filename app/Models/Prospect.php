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
        'email',
        'phone',
        'company',
    ];

    // Relationship with ProspectStatus (One to One)
    // Relación con ProspectStatus (Uno a Uno)
    public function status()
    {
        return $this->belongsTo(ProspectStatus::class, 'status_id');
    }

    // Relationship with ProspectLocation (One to One)
    // Relación con ProspectLocation (Uno a Uno)
    public function location()
    {
        return $this->belongsTo(ProspectLocation::class, 'location_id');
    }

    // Relationship with ProspectIndustry (One to One)
    // Relación con ProspectIndustry (Uno a Uno)
    public function industry()
    {
        return $this->belongsTo(ProspectIndustry::class, 'industry_id');
    }

    // Relationship with Interactions (One to Many)
    // Relación con Interactions (Uno a Muchos)
    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    // Relationship with Sequences (Many to Many)
    // Relación con Sequences (Muchos a Muchos)
    public function sequences()
    {
        return $this->belongsToMany(Sequence::class, 'contact_sequence')
                    ->withPivot('included_at')
                    ->withTimestamps();
    }    
}