<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SelectSearch extends Component
{
    public string $model;
    public string $selected = '';
    public string $search = '';
    public string $placeholder = 'Select an option';
    public array $options = [];

    public function mount(string $model, array $options, ?string $selected = null, string $placeholder = 'Select an option'): void
    {
        $this->model = $model;
        $this->options = $options;
        $this->selected = $selected ?? '';
        $this->placeholder = $placeholder;
    }

    public function updatedSelected(): void
    {
        $this->dispatch('updateModel', model: $this->model, value: $this->selected);
    }

    public function render()
    {
        return view('livewire.components.select-search');
    }
}