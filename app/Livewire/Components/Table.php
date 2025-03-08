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

    public function mount($model, $columns, $sortable = [])
    {
        $this->model = $model;
        $this->columns = $columns;
        $this->sortable = $sortable;
    }

    public function sort($column)
    {
        if (in_array($column, $this->sortable)) {
            if ($this->sortBy === $column) {
                $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                $this->sortBy = $column;
                $this->sortDirection = 'asc';
            }
        }
    }

    public function render()
    {
        $data = $this->model::orderBy($this->sortBy, $this->sortDirection)->paginate(10);

        return view('livewire.components.table', compact('data'));
    }
}
