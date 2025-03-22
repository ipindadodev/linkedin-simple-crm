<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description'];

    // Relationship with SequencePoints (One to Many)
    // Relación con SequencePoints (Uno a Muchos)
    public function sequence_points()
    {
        return $this->hasMany(SequencePoint::class);
    }    

    // Relationship with Prospects (Many to Many)
    // Relación con Prospects (Muchos a Muchos)
    public function prospects()
    {
        return $this->belongsToMany(Prospect::class, 'contact_sequence')
                    ->withPivot(['included_at', 'start_at', 'calculated_dates'])
                    ->withTimestamps();
    }

    // Relationship with ContactSequences (One to Many)
    // Relación con ContactSequences (Uno a Muchos)
    // Pivot table: contact_sequences
    public function contactSequences()
    {
        return $this->hasMany(ContactSequence::class);
    }
}
