<?php

namespace App\Livewire\Locations;

use Livewire\Component;
use App\Models\ProspectLocation;

class Create extends Component
{
    public $name;
    public $code;

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:prospect_locations,code',
    ];

    public function save()
    {
        $this->validate();

        ProspectLocation::create([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        session()->flash('success', __('Location created successfully!'));
        return redirect()->route('locations.index');
    }

    public function render()
    {
        return view('livewire.locations.create');
    }
}
