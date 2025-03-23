<div class="w-full mx-auto bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">

    <!-- Pendientes para hoy o antes -->
    <flux:heading size="lg" class="mb-4 text-center">
        {{ __('Pending tasks for today') }}
        @if (count($todos) > 0)
            ({{ count($todos) }})
        @endif
    </flux:heading>

    @forelse ($todos as $entry)
        @php
            $hasOverdue = collect($entry['steps'])->some(fn($s) => $s['send_date']->isPast());
        @endphp

        <a href="{{ route('prospects.show', $entry['prospect']->id) }}"
           class="block mb-6 p-4 rounded-lg transition
               {{ $hasOverdue
                   ? 'bg-orange-100 dark:bg-orange-900 border border-orange-300 dark:border-orange-700'
                   : 'bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700' }}">
            <div class="flex justify-between items-center mb-2">
                <div class="flex items-center gap-2">
                    <h2 class="text-md font-semibold text-gray-900 dark:text-gray-100">
                        {{ $entry['prospect']->first_name }} {{ $entry['prospect']->last_name }}
                    </h2>
                    @if ($hasOverdue)
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full 
                            bg-orange-500 text-white dark:bg-orange-600">
                            {{ __('Overdue') }}
                        </span>
                    @endif
                </div>

                <span class="text-blue-600 dark:text-blue-400 text-sm">
                    {{ __('View prospect') }} →
                </span>
            </div>

            <ul class="space-y-3 ml-4">
                @foreach ($entry['steps'] as $step)
                    <li class="text-sm text-gray-700 dark:text-gray-300">
                        <strong>{{ __('Sequence:') }}</strong> {{ $step['sequence'] }}<br>
                        <strong class="{{ $step['send_date']->isPast() ? 'text-red-600 dark:text-red-400' : '' }}">
                            {{ __('Date:') }}
                        </strong>
                        {{ $step['send_date']->translatedFormat('l, d F Y') }}
                    </li>
                @endforeach
            </ul>
        </a>
    @empty
        <p class="text-gray-500 dark:text-gray-400 text-center italic">
            {{ __('No tasks pending for today.') }}
        </p>
    @endforelse

    <!-- Próximas tareas -->
    <flux:heading size="lg" class="mb-4 mt-10 text-center">
        {{ __('Upcoming tasks for the week') }}
        @if (count($upcoming) > 0)
            ({{ count($upcoming) }})
        @endif
    </flux:heading>

    @forelse ($upcoming as $step)
        <a href="{{ route('prospects.show', $step['prospect']->id) }}"
           class="block mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg 
                  bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <div class="flex justify-between items-center mb-2">
                <div>
                    <h3 class="text-md font-semibold text-gray-800 dark:text-gray-100">
                        {{ $step['prospect']->first_name }} {{ $step['prospect']->last_name }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <strong>{{ __('Date:') }}</strong> {{ $step['send_date']->translatedFormat('l, d F Y') }}<br>
                        <strong>{{ __('Sequence:') }}</strong> {{ $step['sequence'] }}
                    </p>
                </div>
            </div>
        </a>
    @empty
        <p class="text-gray-500 dark:text-gray-400 text-center italic">
            {{ __('No upcoming tasks for the next days.') }}
        </p>
    @endforelse

</div>