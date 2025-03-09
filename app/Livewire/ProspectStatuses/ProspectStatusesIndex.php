<?php

namespace App\Livewire\ProspectStatuses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProspectStatus;

class ProspectStatusesIndex extends Component
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
    public function statuses()
    {
        return ProspectStatus::orderBy($this->sortBy, $this->sortDirection)->paginate(6);
    }

    public function handleDelete($payload = null)
    {
        if (!$payload) {
            return;
        }
        
        $model = $payload['model'] ?? null;
        $id = $payload['id'] ?? null;
    
        if ($model !== ProspectStatus::class) {
            return;
        }
    
        $status = ProspectStatus::find($id);
    
        if (!$status) {
            session()->flash('error', __('Prospect status not found.'));
            return;
        }
    
        $status->delete();
        session()->flash('message', __('Prospect status deleted successfully.'));
    
        // Emitir evento para refrescar la tabla
        $this->dispatchBrowserEvent('refreshTable');
    }
    

    public function render()
    {
        return view('livewire.prospect-statuses.index', [
            'statuses' => $this->statuses(),
        ]);
    }
}
