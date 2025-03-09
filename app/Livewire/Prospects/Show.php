<?php

namespace App\Livewire\Prospects;

use Livewire\Component;
use App\Models\Prospect;

class Show extends Component
{
    public Prospect $prospect;

    protected $listeners = ['interactionUpdated' => 'refreshProspect'];

    public function mount($id)
    {
        $this->prospect = Prospect::with(['location', 'status', 'industry', 'interactions', 'sequences'])
            ->findOrFail($id);

        $this->dispatch('setProspectId', $this->prospect->id);
    }

    public function refreshProspect()
    {
        $this->prospect->refresh();
    }

    public function render()
    {
        return view('livewire.prospects.show', [
            'prospect' => $this->prospect,
        ]);
    }
}