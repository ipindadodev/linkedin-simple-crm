<?php

namespace App\Livewire\Sequences;

use Livewire\Component;
use App\Models\Sequence;

class Create extends Component
{
    public string $code = '';
    public string $name = '';
    public string $description = '';

    protected $rules = [
        'code' => 'required|string|unique:sequences,code|max:255',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        Sequence::create([
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        return redirect()->route('sequences.index');
    }

    public function render()
    {
        return view('livewire.sequences.create');
    }
}
