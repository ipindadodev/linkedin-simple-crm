<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactSequence extends Pivot
{
    protected $table = 'contact_sequence'; // Nombre personalizado de la tabla

    protected $fillable = [
        'prospect_id',
        'sequence_id',
        'included_at',
        'start_at',
        'calculated_dates',
    ];

    protected $casts = [
        'included_at' => 'datetime',
        'start_at' => 'datetime',
        'calculated_dates' => 'array', // Acceso automático como array PHP
    ];

    public function prospect(): BelongsTo
    {
        return $this->belongsTo(Prospect::class);
    }

    public function sequence(): BelongsTo
    {
        return $this->belongsTo(Sequence::class);
    }
}
