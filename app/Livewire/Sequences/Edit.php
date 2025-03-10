<?php

namespace App\Livewire\Sequences;

use Livewire\Component;
use App\Models\Sequence;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    public Sequence $sequence;
    
    public string $code;
    public string $name;
    public ?string $description = null;

    protected function rules()
    {
        return [
            'code' => ['required', 'string', 'max:255', Rule::unique('sequences', 'code')->ignore($this->sequence->id)],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    public function mount($id)
    {
        $this->sequence = Sequence::findOrFail($id);
        
        // Asignamos valores desde el modelo a las propiedades
        $this->code = $this->sequence->code;
        $this->name = $this->sequence->name;
        $this->description = $this->sequence->description ?? '';

        Log::info('Montando secuencia para edición', $this->sequence->toArray());
    }

    public function update()
    {
        $this->validate();

        // Guardamos los cambios en el modelo
        $this->sequence->update([
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('success', __('Sequence updated successfully!'));

        return redirect()->route('sequences.index');
    }

    public function render()
    {
        return view('livewire.sequences.edit');
    }
}