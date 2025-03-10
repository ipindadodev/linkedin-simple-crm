<?php

namespace App\Livewire\SequencePoints;

use Livewire\Component;
use App\Models\SequencePoint;

class Show extends Component
{
    public SequencePoint $sequencePoint;

    public function mount($id)
    {
        $this->sequencePoint = SequencePoint::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.sequence-points.show', [
            'sequencePoint' => $this->sequencePoint,
        ]);
    }
}