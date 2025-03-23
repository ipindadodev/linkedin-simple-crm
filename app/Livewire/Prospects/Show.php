<?php

namespace App\Livewire\Prospects;

use Livewire\Component;
use App\Models\Prospect;

class Show extends Component
{
    public Prospect $prospect;

    protected $listeners = ['interactionUpdated' => 'refreshProspect', 'refreshProspect' => 'refreshProspect'];
    public array|null $nextStep = null;

    protected function computeNextStep(): void
    {
        $this->nextStep = $this->prospect->sequences
            ->flatMap(fn ($seq) => collect($seq->pivot->calculated_dates ?? [])
                ->map(fn ($step) => array_merge($step, [
                    'sequence_name' => $seq->name,
                    'sequence_id' => $seq->id,
                ]))
            )
            ->filter(fn ($step) => empty($step['done']))
            ->sortBy('send_date')
            ->first();
    }


    public function mount($id)
    {
        $this->prospect = Prospect::with([
            'location', 'status', 'industry', 'interactions', 'sequences'
        ])->findOrFail($id);
    
        $this->computeNextStep();
        $this->dispatch('setProspectId', $this->prospect->id);
    }
    
    public function refreshProspect()
    {
        $this->prospect->refresh();
        $this->computeNextStep();
    }
    

    public function render()
    {
        return view('livewire.prospects.show', [
            'prospect' => $this->prospect,
        ]);
    }
}