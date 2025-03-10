<div class="w-full h-8xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md overflow-y-auto">
    <flux:heading size="lg" class="mb-6 text-center">{{ __('Sequence Point Details') }}</flux:heading>

    <div class="grid grid-cols-2 gap-6 mb-6">
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Sequence ID') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $sequencePoint->sequence_id }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Order') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $sequencePoint->order }}</span>
        </div>
    </div>

    <div class="mb-6">
        <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Message') }}</p>
        <p class="text-gray-900 dark:text-gray-100">{{ $sequencePoint->message }}</p>
    </div>

    <div class="grid grid-cols-2 gap-6 mb-6">
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Type') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ ucfirst($sequencePoint->time_type) }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('When') }}</p>
            <span class="text-gray-900 dark:text-gray-100">
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
            </span>
        </div>
    </div>

    <div class="flex justify-end mt-6">
        <flux:button as="a" href="{{ route('sequence-points.edit', $sequencePoint->id) }}" variant="primary">
            {{ __('Edit sequence point') }}
        </flux:button>
    </div>
</div>