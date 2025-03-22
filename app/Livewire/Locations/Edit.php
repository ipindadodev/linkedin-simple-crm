<?php

namespace App\Livewire\Locations;

use Livewire\Component;
use App\Models\ProspectLocation;
use Illuminate\Support\Facades\Session;

class Edit extends Component
{
    public ProspectLocation $location;
    public ?string $name = null;
    public ?string $code = null;

    public function mount(int $id)
    {
        $this->location = ProspectLocation::findOrFail($id);
        $this->name = $this->location->name;
        $this->code = $this->location->code;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:prospect_locations,code,' . $this->location->id,
        ]);

        $this->location->update([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        Session::flash('message', __('Location updated successfully.'));
        return redirect()->route('locations.index');
    }

    public function render()
    {
        return view('livewire.locations.edit');
    }
}
