<?php

namespace App\Livewire\Sequences;

use Livewire\Component;
use App\Models\Sequence;

class Show extends Component
{
    public Sequence $sequence;

    public function mount(Sequence $sequence)
    {
        $this->sequence = $sequence->load('sequence_points');
    }

    public function render()
    {
        return view('livewire.sequences.show', [
            'sequence' => $this->sequence,
        ]);
    }
}

