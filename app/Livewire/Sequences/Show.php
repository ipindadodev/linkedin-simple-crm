<?php

namespace App\Livewire\Sequences;

use Livewire\Component;
use App\Models\Sequence;
use Carbon\Carbon;

class Show extends Component
{
    public Sequence $sequence;
    public array $sequencePoints = [];

    public function mount($id)
    {
        $this->sequence = Sequence::findOrFail($id)->load('sequence_points');
        $this->prepareSequencePoints();
    }
    

    private function prepareSequencePoints()
    {
        $startDate = Carbon::now();

        $this->sequencePoints = $this->sequence->sequence_points->map(function ($point) use ($startDate) {
            return [
                'order' => $point->order,
                'message' => $point->message,
                'time_type' => $this->translateTimeType($point->time_type),
                'when' => $this->calculateWhen($point),
                'send_date' => $this->calculateSendDate($point, $startDate),
            ];
        })->toArray();
    }

    private function translateTimeType(string $type): string
    {
        return match ($type) {
            'daily' => __('Daily'),
            'weekly' => __('Weekly'),
            'monthly' => __('Monthly'),
            'quarterly' => __('Quarterly'),
            'dynamic' => __('Dynamic'),
            default => __('Unknown'),
        };
    }

    private function calculateWhen($point): string
    {
        return match ($point->time_type) {
            'weekly' => __('Every') . ' ' . ucfirst(__($point->day_of_week)),
            'monthly' => __('Every month on day') . ' ' . $point->day_of_month,
            'dynamic' => $point->days_after_start 
                ? __('Days after start') . ': ' . $point->days_after_start 
                : ($point->days_after_previous ? __('Days after previous') . ': ' . $point->days_after_previous : '-'),
            default => '-',
        };
    }

    private function calculateSendDate($point, Carbon $startDate): string
    {
        $sendDate = match ($point->time_type) {
            'daily' => $startDate->copy()->addDay(),
            'weekly' => $startDate->copy()->next($point->day_of_week ?? 'monday'),
            'monthly' => $startDate->copy()->day($point->day_of_month ?? 1),
            'quarterly' => $startDate->copy()->addMonths(3),
            'dynamic' => $point->days_after_start 
                ? $startDate->copy()->addDays($point->days_after_start) 
                : ($point->days_after_previous ? $startDate->copy()->addDays($point->days_after_previous) : $startDate),
            default => $startDate,
        };

        return $sendDate->translatedFormat('l, j F Y');
    }

    public function render()
    {
        return view('livewire.sequences.show', [
            'sequence' => $this->sequence,
            'sequencePoints' => $this->sequencePoints,
            'startDate' => Carbon::now()->translatedFormat('l, j F Y'),
        ]);
    }
}