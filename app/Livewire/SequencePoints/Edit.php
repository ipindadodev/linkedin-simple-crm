<?php

namespace App\Livewire\SequencePoints;

use Livewire\Component;
use App\Models\SequencePoint;
use App\Models\Sequence;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    public SequencePoint $sequencePoint;

    public array $sequences = [];

    // Variables del formulario
    public ?int $sequence_id = null;
    public ?int $order = null;
    public ?string $message = null;
    public ?string $time_type = null;
    public ?string $day_of_week = null;
    public ?int $day_of_month = null;
    public ?int $days_after_start = null;
    public ?int $days_after_previous = null;
    public ?string $goal = null;

    protected function rules()
    {
        return [
            'sequence_id' => 'required|exists:sequences,id',
            'order' => 'required|integer|min:1',
            'message' => 'required|string',
            'time_type' => 'required|in:daily,weekly,monthly,quarterly,dynamic',
            'day_of_week' => 'nullable|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'day_of_month' => 'nullable|integer|min:1|max:31',
            'days_after_start' => 'nullable|integer|min:0',
            'days_after_previous' => 'nullable|integer|min:0',
            'goal' => 'nullable|string',
        ];
    }

    public function mount($id)
    {
        Log::info("⏳ Cargando datos del punto de secuencia con ID: $id");

        $this->sequencePoint = SequencePoint::findOrFail($id);
        $this->sequences = Sequence::pluck('name', 'id')->toArray();

        Log::info('🔍 Datos del modelo:', $this->sequencePoint->toArray());

        // Asignar valores desde el modelo
        $this->sequence_id = $this->sequencePoint->sequence_id;
        $this->order = $this->sequencePoint->order;
        $this->message = $this->sequencePoint->message;
        $this->time_type = $this->sequencePoint->time_type;
        $this->day_of_week = $this->sequencePoint->day_of_week;
        $this->day_of_month = $this->sequencePoint->day_of_month;
        $this->days_after_start = $this->sequencePoint->days_after_start;
        $this->days_after_previous = $this->sequencePoint->days_after_previous;
        $this->goal = $this->sequencePoint->goal;

        Log::info("✅ Datos asignados correctamente en Livewire.");
    }

    public function update()
    {
        Log::info("🔄 Actualizando punto de secuencia ID: " . $this->sequencePoint->id);
        Log::info("📥 Datos antes de la validación:", [
            'sequence_id' => $this->sequence_id,
            'order' => $this->order,
            'message' => $this->message,
            'time_type' => $this->time_type,
            'day_of_week' => $this->day_of_week,
            'day_of_month' => $this->day_of_month,
            'days_after_start' => $this->days_after_start,
            'days_after_previous' => $this->days_after_previous,
            'goal' => $this->goal,
        ]);

        $this->validate();

        $this->sequencePoint->update([
            'sequence_id' => $this->sequence_id,
            'order' => $this->order,
            'message' => $this->message,
            'time_type' => $this->time_type,
            'day_of_week' => $this->day_of_week,
            'day_of_month' => $this->day_of_month,
            'days_after_start' => $this->days_after_start,
            'days_after_previous' => $this->days_after_previous,
            'goal' => $this->goal,
        ]);

        Log::info("✅ Punto de secuencia actualizado con éxito.");

        session()->flash('success', __('Sequence point updated successfully!'));
        return redirect()->route('sequence-points.index');
    }

    public function render()
    {
        return view('livewire.sequence-points.edit', [
            'sequences' => $this->sequences,
        ]);
    }
}