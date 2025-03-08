<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SequencePoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'sequence_id',
        'order',
        'message',
        'time_type',
        'day_of_week',
        'day_of_month' => 'integer',
        'days_after_start',
        'days_after_previous',
        'goal',
    ];

    // Relationship with Sequence (Many to One)
    // Relación con Sequence (Muchos a Uno)
    public function sequence()
    {
        return $this->belongsTo(Sequence::class);
    }
}
