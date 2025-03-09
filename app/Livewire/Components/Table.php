<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;

class Table extends Component
{
    use WithPagination;

    public string $model;
    public array $columns = [];
    public array $sortable = [];
    public array $searchable = [];
    public bool $allowEditing = false;
    public bool $allowDeleting = false;
    public string $sortBy = 'id';
    public string $sortDirection = 'asc';
    public string $search = '';
    
    // Propiedad para la ruta de edición
    public ?string $editRoute = null;

    // Nueva propiedad: Define qué relaciones cargar y qué campo mostrar
    public array $relations = [];

    public function mount(
        string $model,
        array $columns,
        array $sortable = [],
        array $searchable = [],
        bool $allowEditing = false,
        bool $allowDeleting = false,
        ?string $editRoute = null,
        array $relations = [] // Nueva propiedad opcional
    ) {
        $this->model = $model;
        $this->columns = $columns;
        $this->sortable = $sortable;
        $this->searchable = $searchable;
        $this->allowEditing = $allowEditing;
        $this->allowDeleting = $allowDeleting;
        $this->editRoute = $editRoute;
        $this->relations = $relations; // Guardamos relaciones
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

    #[\Livewire\Attributes\Computed]
    public function data()
    {
        /** @var Model $model */
        $model = app($this->model);
        $query = $model::query();
    
        if (!empty($this->search) && !empty($this->searchable)) {
            $query->where(function ($q) {
                foreach ($this->searchable as $column) {
                    $q->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        }
    
        // Cargar solo relaciones válidas, ignorando columnas tipo *_id
        $relationsToLoad = collect($this->relations)
            ->pluck('relation')
            ->filter()
            ->toArray();
    
        if (!empty($relationsToLoad)) {
            $query->with($relationsToLoad);
        }
    
        return $query->orderBy($this->sortBy, $this->sortDirection)->paginate(6);
    }

    public function triggerDelete($model, $id)
    {
        $modelClass = $this->model;
        $record = $modelClass::find($id);
        if ($record) {
            $record->delete();
            session()->flash('message', __('Registro eliminado correctamente.'));
        } else {
            session()->flash('error', __('Registro no encontrado.'));
        }
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.components.table', [
            'data' => $this->data(),
            'editRoute' => $this->editRoute,
            'relations' => $this->relations, // Pasamos relaciones a la vista
        ]);
    }
}