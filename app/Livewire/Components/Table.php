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
    public $showDeleteModal = false;
    public $deleteId = null;

    protected $listeners = ['confirmDelete']; // 👈 Escucha el evento

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

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->deleteId) {
            ProspectStatus::findOrFail($this->deleteId)->delete();
            session()->flash('message', __('Prospect status deleted successfully.'));
            $this->reset(['showDeleteModal', 'deleteId']);
        }
    }

    public function render()
    {
        return view('livewire.prospect-statuses.index', [
            'statuses' => $this->statuses(),
        ]);
    }
}