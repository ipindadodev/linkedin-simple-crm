<?php

namespace App\Livewire\Components;

use App\Models\Prospect;
use App\Models\Sequence;
use Livewire\Component;
use App\Services\ContactSequenceService;

class AssignSequenceToProspect extends Component
{
    public Prospect $prospect;
    public ?int $sequence_id = null;

    public function assign()
    {
        $this->validate([
            'sequence_id' => ['required', 'exists:sequences,id'],
        ]);

        try {
            $sequence = Sequence::find($this->sequence_id);
            app(ContactSequenceService::class)->assign($this->prospect, $sequence);

            $this->dispatch('sequenceAssigned');
            $this->dispatch('notify', __('Sequence assigned successfully!'));

            $this->reset('sequence_id');

            redirect()->route('prospects.show', $this->prospect);
        } catch (\Throwable $e) {
            $this->dispatch('notify', $e->getMessage()); // podrías mostrarlo como toast si lo prefieres
        }
    }

    public function render()
    {
        return view('livewire.components.assign-sequence-to-prospect', [
            'availableSequences' => Sequence::whereDoesntHave('prospects', fn ($q) =>
                $q->where('prospect_id', $this->prospect->id)
            )->pluck('name', 'id'),
        ]);
    }
}