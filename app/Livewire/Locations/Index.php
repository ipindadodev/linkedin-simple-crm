<?php

namespace App\Livewire\Locations;

use App\Models\ProspectLocation;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $showDeleteModal = false;
    public $deleteId = null;

    protected $listeners = ['deleteItem' => 'handleDelete'];

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
    public function locations()
    {
        return ProspectLocation::orderBy($this->sortBy, $this->sortDirection)->paginate(6);
    }

    public function handleDelete($payload = null)
    {
        if (!$payload) {
            return;
        }

        $model = $payload['model'] ?? null;
        $id = $payload['id'] ?? null;

        if ($model !== ProspectLocation::class) {
            return;
        }

        $location = ProspectLocation::find($id);

        if (!$location) {
            session()->flash('error', __('Prospect location not found.'));
            return;
        }

        $location->delete();
        session()->flash('message', __('Prospect location deleted successfully.'));

        $this->dispatchBrowserEvent('refreshTable');
    }

    public function render()
    {
        return view('livewire.locations.index', [
            'locations' => $this->locations(),
        ]);
    }
}
