<?php

namespace App\Livewire\ProspectStatuses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProspectStatus;

class ProspectStatusesIndex extends Component // 👈 Nombre corregido
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $showDeleteModal = false;
    public $deleteId = null;

    protected $listeners = ['delete-item' => 'handleDelete', 'refreshTable' => '$refresh'];

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

    public function handleDelete($model, $id)
    {
        // Verificamos si el modelo recibido es el correcto
        if ($model !== ProspectStatus::class) {
            return; // Si no es ProspectStatus, ignoramos la eliminación
        }
    
        // Buscamos el registro en la base de datos
        $status = ProspectStatus::find($id);
    
        if (!$status) {
            session()->flash('error', __('Prospect status not found.'));
            return;
        }
    
        // Eliminamos el registro
        $status->delete();
        session()->flash('message', __('Prospect status deleted successfully.'));
    
        // Emitimos un evento para refrescar la tabla
        $this->dispatch('refresh-table');
    }

    public function render()
    {
        return view('livewire.prospect-statuses.index', [
            'statuses' => $this->statuses(),
        ]);
    }
}
