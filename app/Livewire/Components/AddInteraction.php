<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Interaction;

class AddInteraction extends Component
{
    public bool $isOpen = false;
    public ?int $prospectId = null;
    public ?int $interactionId = null;
    public string $title = '';
    public string $description = '';
    public string $created_at = '';
    public string $updated_at = '';

    protected $listeners = ['editInteraction', 'setProspectId'];

    public function setProspectId($prospectId)
    {
        $this->prospectId = $prospectId;
    }

    public function openModal(?int $interactionId = null)
    {
        $this->interactionId = $interactionId;

        if ($interactionId) {
            $interaction = Interaction::findOrFail($interactionId);
            $this->title = $interaction->title;
            $this->description = $interaction->description;
            $this->created_at = $interaction->created_at->format('d/m/Y H:i');
            $this->updated_at = $interaction->updated_at->format('d/m/Y H:i');
        } else {
            $this->reset(['title', 'description', 'interactionId', 'created_at', 'updated_at']);
        }

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->reset(['isOpen', 'interactionId', 'title', 'description', 'created_at', 'updated_at']);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($this->interactionId) {
            $interaction = Interaction::findOrFail($this->interactionId);
            $interaction->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);
        } else {
            Interaction::create([
                'prospect_id' => $this->prospectId,
                'title' => $this->title,
                'description' => $this->description,
            ]);
        }

        $this->dispatch('interactionUpdated');
        $this->closeModal();
    }

    public function editInteraction($interactionId)
    {
        if (is_array($interactionId)) {
            $interactionId = $interactionId[0]; // Extrae el ID si viene en array
        }
        
        $this->openModal($interactionId);
    }
    
    

    public function render()
    {
        return view('livewire.components.add-interaction');
    }
}