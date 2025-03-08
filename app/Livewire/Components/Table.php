<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Table extends Component
{
    use WithPagination;

    // Nombre completo del modelo, por ejemplo: App\Models\ProspectStatus
    public string $model;
    // Arreglo asociativo de columnas: 'clave' => 'Etiqueta'
    public array $columns = [];
    // Columnas habilitadas para ordenamiento
    public array $sortable = [];
    // Columnas en las que se aplicará búsqueda
    public array $searchable = [];
    // Permite o no la edición externa (con enlace)
    public bool $allowEditing = false;
    // Permite o no la eliminación directa
    public bool $allowDeleting = false;
    // Ordenamiento
    public string $sortBy = 'id';
    public string $sortDirection = 'asc';
    // Término de búsqueda
    public string $search = '';

    // Método de inicialización del componente
    public function mount(
        string $model,
        array $columns,
        array $sortable = [],
        array $searchable = [],
        bool $allowEditing = false,
        bool $allowDeleting = false
    ) {
        $this->model = $model;
        $this->columns = $columns;
        $this->sortable = $sortable;
        $this->searchable = $searchable;
        $this->allowEditing = $allowEditing;
        $this->allowDeleting = $allowDeleting;
    }

    /**
     * Cambia el ordenamiento cuando se hace clic en el encabezado de la columna.
     */
    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Propiedad computada que retorna los registros filtrados, ordenados y paginados.
     */
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

        return $query->orderBy($this->sortBy, $this->sortDirection)->paginate(6);
    }

    /**
     * Elimina un registro dado su id.
     */
    public function triggerDelete($model, $id)
    {
        // Para mayor seguridad, podrías comparar $model recibido con $this->model
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
        ]);
    }
}