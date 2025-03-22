<?php

namespace App\Services;

use App\Models\Prospect;
use App\Models\Sequence;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactSequenceService
{
    public function assign(Prospect $prospect, Sequence $sequence): void
    {
        if ($this->alreadyAssigned($prospect, $sequence)) {
            throw new \Exception(__('This prospect is already assigned to the sequence.'));
        }

        $startAt = $this->nextBusinessDay(Carbon::now());
        $points = $sequence->sequence_points()->orderBy('order')->get();

        $calculatedDates = [];
        $lastDate = null;

        foreach ($points as $point) {
            $sendDate = match ($point->time_type) {
                'daily'     => $startAt->copy()->addDay(),
                'weekly'    => $startAt->copy()->next($point->day_of_week ?? 'monday'),
                'monthly'   => $startAt->copy()->day($point->day_of_month ?? 1),
                'quarterly' => $startAt->copy()->addMonths(3),
                'dynamic'   => $this->calculateDynamicDate($startAt, $lastDate, $point),
                default     => $startAt,
            };

            $sendDate = $this->nextBusinessDay($sendDate);

            $calculatedDates[] = [
                'point_id' => $point->id,
                'send_date' => $sendDate->toDateString(),
                'message' => $point->message,
                'goal' => $point->goal,
            ];

            $lastDate = $sendDate;
        }

        DB::table('contact_sequence')->insert([
            'prospect_id' => $prospect->id,
            'sequence_id' => $sequence->id,
            'included_at' => now(),
            'start_at' => $startAt,
            'calculated_dates' => json_encode($calculatedDates),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function calculateDynamicDate(Carbon $start, ?Carbon $last, $point): Carbon
    {
        if ($point->days_after_start !== null) {
            return $start->copy()->addDays($point->days_after_start);
        }

        if ($last && $point->days_after_previous !== null) {
            return $last->copy()->addDays($point->days_after_previous);
        }

        return $start->copy();
    }

    protected function nextBusinessDay(Carbon $date): Carbon
    {
        while ($date->isWeekend()) {
            $date->addDay();
        }

        return $date;
    }

    protected function alreadyAssigned(Prospect $prospect, Sequence $sequence): bool
    {
        return DB::table('contact_sequence')
            ->where('prospect_id', $prospect->id)
            ->where('sequence_id', $sequence->id)
            ->exists();
    }
}
