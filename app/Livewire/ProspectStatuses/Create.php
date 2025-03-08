<?php

namespace App\Livewire\ProspectStatuses;

use Livewire\Component;
use App\Models\ProspectStatus;

class Create extends Component
{
    public $name;
    public $code;
    public $description;
    public $color = '#000000';

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:prospect_statuses,code',
        'description' => 'nullable|string',
        'color' => 'required|string|max:7', // Hex color
    ];

    public function save()
    {
        $this->validate();

        ProspectStatus::create([
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'color' => $this->color,
        ]);

        session()->flash('success', __('Prospect status created successfully!'));
        return redirect()->route('prospect-statuses.index');
    }

    public function render()
    {
        return view('livewire.prospect-statuses.create');
    }
}
