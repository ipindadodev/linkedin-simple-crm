<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Prospect;
use App\Models\Sequence;
use App\Services\ContactSequenceService;

class AssignSequenceToProspect extends Component
{
    public Prospect $prospect;
    public ?int $sequence_id = null;

    public function assign()
    {
        $this->validate([
            'sequence_id' => 'required|exists:sequences,id',
        ]);

        try {
            $sequence = Sequence::findOrFail($this->sequence_id);
            app(ContactSequenceService::class)->assign($this->prospect, $sequence);

            session()->flash('success', __('Sequence assigned successfully!'));
            $this->reset('sequence_id');

            // Opcional: emitir evento para refrescar si es necesario
            $this->dispatch('sequenceAssigned');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        $availableSequences = Sequence::whereNotIn('id', $this->prospect->sequences->pluck('id'))->pluck('name', 'id');

        return view('livewire.components.assign-sequence-to-prospect', [
            'availableSequences' => $availableSequences,
        ]);
    }
}
