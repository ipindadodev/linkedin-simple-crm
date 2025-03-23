<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Prospect;
use Carbon\Carbon;

class DashboardTodos extends Component
{
    public array $todos = [];
    public array $upcoming = [];

    public function mount()
    {
        $today = Carbon::today();
        $nextWeek = Carbon::today()->addWeek()->endOfWeek();

        $this->todos = [];
        $upcomingSteps = [];

        $prospects = Prospect::with(['sequences'])->get();

        foreach ($prospects as $prospect) {
            $pendingToday = [];

            foreach ($prospect->sequences as $sequence) {
                foreach ($sequence->pivot->calculated_dates ?? [] as $index => $step) {
                    if (empty($step['done'])) {
                        $sendDate = Carbon::parse($step['send_date']);

                        $entry = [
                            'prospect' => $prospect,
                            'sequence' => $sequence->name,
                            'stepIndex' => $index,
                            'goal' => $step['goal'] ?? '-',
                            'send_date' => $sendDate,
                            'message' => replace_placeholders($step['message'], $prospect),
                        ];

                        if ($sendDate->lessThanOrEqualTo($today)) {
                            $pendingToday[] = $entry;
                        } elseif ($sendDate->isBetween($today->copy()->addDay(), $nextWeek)) {
                            $upcomingSteps[] = $entry;
                        }
                    }
                }
            }

            if (!empty($pendingToday)) {
                $this->todos[] = [
                    'prospect' => $prospect,
                    'steps' => $pendingToday,
                ];
            }
        }

        // Ordenar pasos futuros globalmente por fecha
        usort($upcomingSteps, fn($a, $b) => $a['send_date']->timestamp <=> $b['send_date']->timestamp);

        $this->upcoming = $upcomingSteps;
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-todos');
    }
}