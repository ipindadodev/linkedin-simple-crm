<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public string $model;
    public array $columns = [];
    public array $sortable = [];
    public array $searchable = [];
    public bool $allowEditing = false;
    public bool $allowDeleting = false;
    public bool $allowViewing = false;
    public string $sortBy = 'id';
    public string $sortDirection = 'asc';
    public string $search = '';
    public ?string $editRoute = null;
    public ?string $viewRoute = null;
    public array $relations = [];

    public function mount(
        string $model,
        array $columns,
        array $sortable = [],
        array $searchable = [],
        bool $allowEditing = false,
        bool $allowDeleting = false,
        bool $allowViewing = false,
        ?string $editRoute = null,
        ?string $viewRoute = null,
        array $relations = [],
    ): void {
        $this->model = $model;
        $this->columns = $columns;
        $this->sortable = $sortable;
        $this->searchable = $searchable;
        $this->allowEditing = $allowEditing;
        $this->allowDeleting = $allowDeleting;
        $this->allowViewing = $allowViewing;
        $this->editRoute = $editRoute;
        $this->viewRoute = $viewRoute;
        $this->relations = $relations;
    }

    public function sort(string $column): void
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
        $model = app($this->model);
        $query = $model::query();

        if ($this->search && $this->searchable) {
            $query->where(function ($q) {
                foreach ($this->searchable as $column) {
                    $q->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        }

        if (!empty($this->relations)) {
            $query->with(collect($this->relations)->pluck('relation')->filter()->all());
        }

        return $query->orderBy($this->sortBy, $this->sortDirection)->paginate(7);
    }

    public function triggerDelete(string $model, int $id): void
    {
        $modelClass = $this->model;

        if (class_exists($modelClass)) {
            $record = $modelClass::find($id);

            if ($record) {
                $record->delete();
                session()->flash('message', __('Record deleted successfully.'));
            } else {
                session()->flash('error', __('Record not found.'));
            }

            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.components.table', [
            'data' => $this->data(),
        ]);
    }
}
