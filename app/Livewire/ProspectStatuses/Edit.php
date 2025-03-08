<?php

namespace App\Livewire\ProspectStatuses;

use Livewire\Component;
use App\Models\ProspectStatus;
use Illuminate\Support\Facades\Session;

class Edit extends Component
{
    public $status;
    public $name, $code, $description, $color;

    public function mount(ProspectStatus $status)
    {
        $this->status = $status;
        $this->name = $status->name;
        $this->code = $status->code;
        $this->description = $status->description;
        $this->color = $status->color;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:prospect_statuses,code,' . $this->status->id,
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
        ]);

        $this->status->update([
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'color' => $this->color,
        ]);

        Session::flash('message', __('Prospect status updated successfully.'));
        return redirect()->route('prospect-statuses.index');
    }

    public function render()
    {
        return view('livewire.prospect-statuses.edit');
    }
}
