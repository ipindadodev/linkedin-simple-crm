<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\ContactSequence;

class MarkStepAsDone extends Component
{
    public int $prospectId;
    public int $sequenceId;
    public int $stepIndex;

    public function mark()
    {
        $cs = ContactSequence::where('prospect_id', $this->prospectId)
                             ->where('sequence_id', $this->sequenceId)
                             ->firstOrFail();

        $steps = $cs->calculated_dates;

        if (!isset($steps[$this->stepIndex])) return;

        $steps[$this->stepIndex]['done'] = true;
        $steps[$this->stepIndex]['done_at'] = now()->toDateTimeString();

        $cs->calculated_dates = $steps;
        $cs->save();

        $this->dispatch('stepMarked');
    }

    public function render()
    {
        return view('livewire.components.mark-step-as-done');
    }
}