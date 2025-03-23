<div class="w-full mx-auto bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">

    <!-- Pendientes para hoy o antes -->
    <flux:heading size="lg" class="mb-4 text-center">
        {{ __('Pending tasks for today') }}
    </flux:heading>

    @forelse ($todos as $entry)
        <div class="mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-md font-semibold text-gray-900 dark:text-gray-100">
                    {{ $entry['prospect']->first_name }} {{ $entry['prospect']->last_name }}
                </h2>
                <a href="{{ route('prospects.show', $entry['prospect']->id) }}"
                   class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                    {{ __('View prospect') }}
                </a>
            </div>

            <ul class="space-y-3 ml-4">
                @foreach ($entry['steps'] as $step)
                    <li class="text-sm text-gray-700 dark:text-gray-300">
                        <strong>{{ __('Sequence:') }}</strong> {{ $step['sequence'] }}<br>
                        <strong>{{ __('Date:') }}</strong> {{ $step['send_date']->translatedFormat('l, d F Y') }}<br>
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <p class="text-gray-500 dark:text-gray-400 text-center italic">
            {{ __('No tasks pending for today.') }}
        </p>
    @endforelse

    <!-- Próximas tareas -->
    <flux:heading size="lg" class="mb-4 mt-10 text-center">
        {{ __('Upcoming tasks for the week') }}
    </flux:heading>

    @forelse ($upcoming as $step)
        <div class="mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center mb-2">
                <div>
                    <h3 class="text-md font-semibold text-gray-800 dark:text-gray-100">
                        {{ $step['prospect']->first_name }} {{ $step['prospect']->last_name }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <strong>{{ __('Date:') }}</strong> {{ $step['send_date']->translatedFormat('l, d F Y') }}<br>
                        <strong>{{ __('Sequence:') }}</strong> {{ $step['sequence'] }}<br>
                    </p>
                </div>
                <a href="{{ route('prospects.show', $step['prospect']->id) }}"
                   class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                    {{ __('View prospect') }}
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500 dark:text-gray-400 text-center italic">
            {{ __('No upcoming tasks for the next days.') }}
        </p>
    @endforelse

</div>