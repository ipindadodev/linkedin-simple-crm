<?php

namespace App\Livewire\Sequences;

use Livewire\Component;
use App\Models\Sequence;

class Edit extends Component
{
    public Sequence $sequence;

    protected $rules = [
        'sequence.code' => 'required|string|max:255|unique:sequences,code',
        'sequence.name' => 'required|string|max:255',
        'sequence.description' => 'nullable|string',
    ];

    public function update()
    {
        $this->validate();

        $this->sequence->save();

        return redirect()->route('sequences.index');
    }

    public function render()
    {
        return view('livewire.sequences.edit');
    }
}