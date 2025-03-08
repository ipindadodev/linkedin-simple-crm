<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class Table extends Component
{
    use WithPagination;

    public $model;
    public $columns = [];
    public $sortable = [];
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $allowEditing = false;
    public $allowDeleting = false; // Nuevo: Controla si se puede eliminar
    public $showDeleteModal = false;
    public $deleteId;

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteStatus()
    {
        if ($this->deleteId && $this->allowDeleting) {
            $modelInstance = app($this->model)::find($this->deleteId);
            if ($modelInstance) {
                $modelInstance->delete();
                Session::flash('message', __('Prospect status deleted successfully.'));
            }
        }
        $this->showDeleteModal = false;
    }

    public function render()
    {
        $data = app($this->model)::orderBy($this->sortBy, $this->sortDirection)->paginate(10);

        return view('livewire.components.table', [
            'data' => $data,
        ]);
    }
}