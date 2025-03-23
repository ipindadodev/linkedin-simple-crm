<?php

namespace App\Livewire\Components;

use App\Models\Interaction;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;

class AddInteraction extends Component
{
    public bool $isOpen = false;

    #[Locked]
    public ?int $prospectId = null;

    public ?int $interactionId = null;

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('nullable|string')]
    public string $description = '';

    public string $created_at = '';
    public string $updated_at = '';

    #[On('editInteraction')]
    public function editInteraction($interactionId)
    {
        if (is_array($interactionId)) {
            $interactionId = $interactionId[0];
        }

        $this->openModal($interactionId);
    }

    #[On('setProspectId')]
    public function setProspectId($id)
    {
        $this->prospectId = $id;
    }

    #[On('openModal')]
    public function openModal(?int $interactionId = null, ?int $prospectId = null)
    {
        if ($prospectId) {
            $this->prospectId = $prospectId;
        }

        $this->interactionId = $interactionId;

        if ($interactionId) {
            $interaction = Interaction::findOrFail($interactionId);
            $this->fill([
                'title' => $interaction->title,
                'description' => $interaction->description,
                'created_at' => $interaction->created_at->format('d/m/Y H:i'),
                'updated_at' => $interaction->updated_at->format('d/m/Y H:i'),
            ]);
        } else {
            $this->reset('title', 'description', 'interactionId', 'created_at', 'updated_at');
        }

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->reset('isOpen', 'interactionId', 'title', 'description', 'created_at', 'updated_at');
    }

    public function save()
    {
        $this->validate();

        if (!$this->prospectId) {
            throw new \Exception("Prospect ID is missing.");
        }

        if ($this->interactionId) {
            Interaction::findOrFail($this->interactionId)->update([
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

    public function render()
    {
        return view('livewire.components.add-interaction');
    }
}