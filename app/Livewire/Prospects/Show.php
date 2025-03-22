<?php

namespace App\Livewire\Prospects;

use Livewire\Component;
use App\Models\Prospect;

class Show extends Component
{
    public Prospect $prospect;

    protected $listeners = ['interactionUpdated' => 'refreshProspect', 'refreshProspect' => 'refreshProspect'];

    protected function replacePlaceholders(string $text, \App\Models\Prospect $prospect): string
    {
        $replacements = [
            '{$first_name}' => $prospect->first_name,
            '{$last_name}' => $prospect->last_name,
            '{$second_last_name}' => $prospect->second_last_name,
            '{$email}' => $prospect->email,
            '{$phone}' => $prospect->phone,
            '{$company}' => $prospect->company,
            '{$linkedin_url}' => $prospect->linkedin_url,
            '{$location.name}' => $prospect->location->name ?? '',
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }


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
            'replacePlaceholders' => fn ($text) => $this->replacePlaceholders($text, $this->prospect),
        ]);
    }
    
}