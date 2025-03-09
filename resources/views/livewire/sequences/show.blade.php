<div class="w-full h-8xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md overflow-y-auto">
    <flux:heading size="lg" class="mb-6 text-center">{{ __('Sequence Details') }}</flux:heading>

    <div class="grid grid-cols-3 gap-6 mb-6">
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Code') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $sequence->code }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Name') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $sequence->name }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Description') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $sequence->description }}</span>
        </div>
    </div>

    <!-- Puntos de Secuencia -->
    <flux:heading class="mb-4 mt-6">{{ __('Sequence points') }}</flux:heading>
    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow">
        @forelse ($sequence->sequence_points->sortBy('order') as $point)
            <div class="pb-3 mb-3">
                <h3 class="text-lg font-semibold text-primary-600 dark:text-primary-400">
                    {{ __('Step') }} {{ $point->order }}
                </h3>
                <span class="text-gray-500 dark:text-gray-400 text-[0.9rem]/6 mt-2">
                    <strong>{{ __('Message:') }}</strong> {{ $point->message }} <br>
                    <strong>{{ __('Type:') }}</strong> {{ ucfirst($point->time_type) }} 
                    @if ($point->time_type === 'weekly') - {{ ucfirst($point->day_of_week) }} @endif
                    @if ($point->time_type === 'monthly') - {{ __('Day') }} {{ $point->day_of_month }} @endif
                    @if ($point->days_after_start) - {{ __('After start:') }} {{ $point->days_after_start }} {{ __('days') }} @endif
                    @if ($point->days_after_previous) - {{ __('After previous:') }} {{ $point->days_after_previous }} {{ __('days') }} @endif
                </span>                
            </div>
    
            @if (!$loop->last)
                <flux:separator variant="subtle" />
            @endif
        @empty
            <p class="text-gray-500 dark:text-gray-400">{{ __('No sequence points assigned.') }}</p>
        @endforelse
    </div>

    <div class="flex justify-end mt-6">
        <flux:button as="a" href="{{ route('sequences.edit', $sequence->id) }}" variant="primary">
            {{ __('Edit sequence') }}
        </flux:button>
    </div>
</div>