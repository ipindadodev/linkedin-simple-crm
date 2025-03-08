<?php

namespace App\Livewire\ProspectStatuses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProspectStatus;

class Index extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function statuses()
    {
        return ProspectStatus::orderBy($this->sortBy, $this->sortDirection)->paginate(10);
    }

    public function delete($id)
    {
        ProspectStatus::findOrFail($id)->delete();
        session()->flash('message', __('Prospect status deleted successfully.'));
    }

    public function render()
    {
        return view('livewire.prospect-statuses.index', [
            'statuses' => $this->statuses(),
        ]);
    }
}
