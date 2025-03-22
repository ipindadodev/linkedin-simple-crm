<div class="w-full h-8xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md overflow-y-auto">
    <flux:heading size="lg" class="mb-6 text-center">{{ __('Sequence details') }}</flux:heading>

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

    <!-- Información de inicio de la secuencia -->
    <p class="text-gray-600 dark:text-gray-300 font-semibold mb-4">
        {{ __('If the sequence starts on') }} <strong class="text-gray-900 dark:text-gray-100">{{ $startDate }}</strong>:
    </p>

    <!-- Puntos de Secuencia -->
    <flux:heading class="mb-4 mt-6">{{ __('Sequence points') }}</flux:heading>
    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow">
        @forelse ($sequencePoints as $point)
            <div class="pb-3 mb-3">
                <h3 class="text-lg font-semibold text-primary-600 dark:text-primary-400">
                    {{ __('Step') }} {{ $point['order'] }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400">
                    <strong>{{ __('Message:') }}</strong> {{ $point['message'] }} <br>
                    <strong>{{ __('Type:') }}</strong> {{ $point['time_type'] }} <br>
                    <strong>{{ __('When:') }}</strong> {{ $point['when'] }} <br>
                    
                    <strong>{{ __('Send date:') }}</strong> 
                    {{ __('If the sequence starts on') }} {{ $startDate }}, 
                    {{ __('this message will be sent on') }} 
                    <strong class="text-gray-900 dark:text-gray-100">{{ $point['send_date'] }}</strong>

                    @if ($point['postponed'])
                        ({{ __('postponed from') }} {{ $point['original_date'] }})
                    @endif
                </p>                
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
