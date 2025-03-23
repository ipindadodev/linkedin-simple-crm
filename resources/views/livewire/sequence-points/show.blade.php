<article class="w-full h-8xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md overflow-y-auto">
    <header>
        <flux:heading size="lg" class="mb-6 text-center">{{ __('Sequence point details') }}</flux:heading>
    </header>

    <section aria-labelledby="basic-info" class="grid grid-cols-2 gap-6 mb-6">
        <div>
            <h2 id="basic-info" class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Sequence ID') }}</h2>
            <p class="text-gray-900 dark:text-gray-100">{{ $sequencePoint->sequence_id }}</p>
        </div>
        <div>
            <h2 class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Order') }}</h2>
            <p class="text-gray-900 dark:text-gray-100">{{ $sequencePoint->order }}</p>
        </div>
    </section>

    <section aria-labelledby="message-content" class="mb-6">
        <h2 id="message-content" class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Message') }}</h2>
        <p class="text-gray-900 dark:text-gray-100">{{ $sequencePoint->message }}</p>
    </section>

    <section aria-labelledby="timing-info" class="grid grid-cols-2 gap-6 mb-6">
        <div>
            <h2 id="timing-info" class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Type') }}</h2>
            <p class="text-gray-900 dark:text-gray-100">{{ ucfirst($sequencePoint->time_type) }}</p>
        </div>
        <div>
            <h2 class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('When') }}</h2>
            <p class="text-gray-900 dark:text-gray-100">
                @if ($sequencePoint->time_type === 'weekly')
                    {{ __('Every') }} {{ ucfirst(__($sequencePoint->day_of_week)) }}
                @elseif ($sequencePoint->time_type === 'monthly')
                    {{ __('Every month on day') }} {{ $sequencePoint->day_of_month }}
                @elseif ($sequencePoint->time_type === 'dynamic')
                    @if ($sequencePoint->days_after_start)
                        {{ __('After start:') }} {{ $sequencePoint->days_after_start }} {{ __('days') }}
                    @elseif ($sequencePoint->days_after_previous)
                        {{ __('After previous:') }} {{ $sequencePoint->days_after_previous }} {{ __('days') }}
                    @else
                        -
                    @endif
                @else
                    -
                @endif
            </p>
        </div>
    </section>

    <footer class="flex justify-end mt-6">
        <flux:button as="a" href="{{ route('sequence-points.edit', $sequencePoint->id) }}" variant="primary">
            {{ __('Edit sequence point') }}
        </flux:button>
    </footer>
</article>
