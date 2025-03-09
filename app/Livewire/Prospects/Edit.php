<?php

namespace App\Livewire\Prospects;

use Livewire\Component;
use App\Models\Prospect;
use App\Models\ProspectLocation;
use App\Models\ProspectStatus;
use App\Models\ProspectIndustry;

class Edit extends Component
{
    public $prospect_id, $first_name, $last_name, $second_last_name, $linkedin_url;
    public $location_id, $status_id, $industry_id;

    protected $listeners = ['updateModel'];

    // ✅ Agregamos las reglas de validación
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'second_last_name' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'location_id' => 'required|exists:prospect_locations,id',
            'status_id' => 'required|exists:prospect_statuses,id',
            'industry_id' => 'required|exists:prospect_industries,id',
        ];
    }

    public function updateModel($model, $value)
    {
        if (property_exists($this, $model)) {
            $this->$model = $value;
        }
    }

    public function mount($id)
    {
        $prospect = Prospect::findOrFail($id);
        $this->prospect_id = $prospect->id;
        $this->fill($prospect->toArray());
    }

    public function update()
    {
        $this->validate(); // ✅ Ahora validará correctamente

        $prospect = Prospect::findOrFail($this->prospect_id);
        $prospect->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'second_last_name' => $this->second_last_name,
            'linkedin_url' => $this->linkedin_url,
            'location_id' => $this->location_id,
            'status_id' => $this->status_id,
            'industry_id' => $this->industry_id,
        ]);

        session()->flash('message', 'Prospect updated successfully.');
        return redirect()->route('prospects.index');
    }

    public function render()
    {
        return view('livewire.prospects.edit', [
            'locations' => ProspectLocation::pluck('name', 'id')->toArray(),
            'statuses' => ProspectStatus::pluck('name', 'id')->toArray(),
            'industries' => ProspectIndustry::pluck('name', 'id')->toArray(),
        ]);
    }
}