<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\ContactSequence;

class ToggleStepStatus extends Component
{
    public int $prospectId;
    public int $sequenceId;
    public int $stepIndex;
    public bool $done = false;

    public function toggle(): void
    {
        $cs = ContactSequence::query()
            ->where('prospect_id', $this->prospectId)
            ->where('sequence_id', $this->sequenceId)
            ->firstOrFail();

        $steps = $cs->calculated_dates;

        if (!isset($steps[$this->stepIndex])) {
            return;
        }

        $isDone = !empty($steps[$this->stepIndex]['done']);
        $steps[$this->stepIndex]['done'] = !$isDone;

        if ($isDone) {
            unset($steps[$this->stepIndex]['done_at']);
        } else {
            $steps[$this->stepIndex]['done_at'] = now()->toDateTimeString();
        }

        $cs->calculated_dates = $steps;
        $cs->save();

        $this->done = !$isDone;

        $this->dispatch('stepMarked');
    }

    public function render()
    {
        return view('livewire.components.toggle-step-status');
    }
}