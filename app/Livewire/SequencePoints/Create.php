<?php

namespace App\Livewire\SequencePoints;

use Livewire\Component;
use App\Models\SequencePoint;
use App\Models\Sequence;
use Illuminate\Support\Facades\Log;

class Create extends Component
{
    public ?int $sequence_id = null; // Inicializar como null para evitar error de acceso
    public int $order = 1;
    public string $message = '';
    public string $time_type = 'dynamic';
    public ?string $day_of_week = null;
    public ?int $day_of_month = null;
    public ?int $days_after_start = null;
    public ?int $days_after_previous = null;
    public ?string $goal = null;

    public $sequences;

    protected $rules = [
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

    public function mount()
    {
        $this->sequences = Sequence::all()->pluck('name', 'id')->toArray();

        // Solo actualizar el orden si sequence_id no es null
        if ($this->sequence_id) {
            $this->updatedSequenceId();
        }

        $this->updatedTimeType();
    }

    public function updatedSequenceId()
    {
        Log::info('updatedSequenceId ejecutado. sequence_id:', ['sequence_id' => $this->sequence_id]);
    
        if ($this->sequence_id === null) {
            Log::warning('sequence_id es NULL en updatedSequenceId');
            return;
        }
    
        $lastOrder = SequencePoint::where('sequence_id', $this->sequence_id)->max('order');
        $this->order = $lastOrder ? $lastOrder + 1 : 1;
    
        Log::info('Orden calculado:', ['order' => $this->order]);
    }
    

    public function updatedTimeType()
    {
        match ($this->time_type) {
            'daily' => $this->reset(['day_of_week', 'day_of_month', 'days_after_start', 'days_after_previous']),
            'weekly', 'monthly', 'quarterly' => $this->reset(['days_after_start', 'days_after_previous']),
            'dynamic' => $this->reset(['day_of_week', 'day_of_month']),
        };
    }

    public function save()
    {
        $this->validate();

        SequencePoint::create([
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

        return redirect()->route('sequence-points.index');
    }

    public function render()
    {
        return view('livewire.sequence-points.create', [
            'sequences' => $this->sequences,
        ]);
    }
}