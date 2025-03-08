<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $model;
    public $columns;
    public $sortable = [];
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $allowEditing = false;
    public $allowDeleting = false;
    public $search = ''; // Campo de búsqueda
    public $searchable = []; // Columnas donde se puede buscar

    protected $queryString = ['search']; // Guarda la búsqueda en la URL

    public function mount()
    {
        $this->sortBy = $this->sortable[0] ?? 'id'; // Orden predeterminado
    }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        if (strlen($this->search) < 2) {
            return; // No filtrar hasta que haya al menos 2 caracteres
        }
        $this->resetPage(); // Resetear la paginación al buscar
    }

    #[\Livewire\Attributes\Computed]
    public function data()
    {
        return $this->model::query()
            ->when(strlen($this->search) >= 2 && count($this->searchable) > 0, function ($query) {
                $query->where(function ($subQuery) {
                    foreach ($this->searchable as $column) {
                        $subQuery->orWhere($column, 'LIKE', '%' . $this->search . '%');
                    }
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.components.table', [
            'data' => $this->data,
        ]);
    }
}