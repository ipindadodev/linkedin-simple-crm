<div class="w-full h-8xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md overflow-y-auto">
    <flux:heading size="lg" class="mb-6 text-center">{{ __('Prospect details') }}</flux:heading>

    @if ($nextStep)
        <div class="mb-6 text-sm text-gray-700 dark:text-gray-300 bg-yellow-50 dark:bg-yellow-900 border border-yellow-300 dark:border-yellow-700 p-4 rounded-lg shadow">
            <strong>{{ __('Next step to execute:') }}</strong><br>
            {{ \Carbon\Carbon::parse($nextStep['send_date'])->translatedFormat('l, d F Y') }}
            – {{ $nextStep['goal'] ?? __('No goal') }}
            <span class="block mt-1 italic text-gray-500 dark:text-gray-400">
                ({{ __('In sequence:') }} {{ $nextStep['sequence_name'] }})
            </span>
        </div>
    @else
        <div class="mb-6 text-sm italic text-green-700 dark:text-green-300">
            {{ __('All sequences completed. No pending steps.') }}
        </div>
    @endif


    <!-- Información general -->
    <div class="grid grid-cols-3 gap-6 mb-6">
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('First name') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $prospect->first_name }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Last name') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $prospect->last_name }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Second last name') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $prospect->second_last_name }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('LinkedIn') }}</p>
            <a href="{{ $prospect->linkedin_url }}" target="_blank" class="text-blue-500 hover:underline">
                {{ __('View profile') }}
            </a>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Email') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $prospect->email }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Phone') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $prospect->phone }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Location') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $prospect->location->name ?? '-' }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Status') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $prospect->status->name ?? '-' }}</span>
        </div>
        <div>
            <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __('Industry') }}</p>
            <span class="text-gray-900 dark:text-gray-100">{{ $prospect->industry->name ?? '-' }}</span>
        </div>
    </div>

    <!-- Sección de Interacciones -->
    <div class="flex justify-between items-center mb-4">
        <flux:heading>{{ __('Interactions') }}</flux:heading>
        <livewire:components.add-interaction :prospectId="$prospect->id" />
    </div>

    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow max-h-96 overflow-y-auto">
        @forelse ($prospect->interactions->sortByDesc('created_at') as $interaction) 
            <div class="pb-3 mb-3">
                <h3 class="text-lg font-semibold text-primary-600 dark:text-primary-400 cursor-pointer hover:underline"
                   wire:click="$dispatch('editInteraction', [{{ $interaction->id }}])">
                   {{ $interaction->title }}
                </h3>
                <span class="text-gray-500 dark:text-gray-400 text-[0.9rem]/6 mt-2">
                    <span class="text-cyan-500">
                        {{ __('Created at:') }} 
                    </span>
                    {{ $interaction->created_at->translatedFormat('l, d \d\e F \d\e Y \a \l\a\s H:i') }}
                    @if ($interaction->updated_at->gt($interaction->created_at))
                        -
                        <span class="text-indigo-500">
                            {{ __('Updated at:') }}
                        </span>
                         {{ $interaction->updated_at->translatedFormat('l, d \d\e F \d\e Y \a \l\a\s H:i') }}
                    @endif
                </span>                
                <p class="text-gray-700 dark:text-gray-300">{{ $interaction->description }}</p>
            </div>
    
            @if (!$loop->last)
                <flux:separator variant="subtle" />
            @endif
        @empty
            <p class="text-gray-500 dark:text-gray-400">{{ __('No interactions recorded.') }}</p>
        @endforelse
    </div>
    

    <!-- Sección de secuencias -->
    <flux:heading class="mb-4 mt-6">{{ __('Sequences') }}</flux:heading>

    <livewire:components.assign-sequence-to-prospect :prospect="$prospect" />
    
    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow">
        @forelse ($prospect->sequences as $sequence)
            <details class="mb-4">
                <summary class="cursor-pointer text-gray-800 dark:text-gray-200 font-semibold hover:underline">
                    {{ $sequence->name }} 
                    ({{ __('Assigned:') }} {{ $sequence->pivot->included_at->format('d/m/Y') }},
                     {{ __('Starts:') }} {{ $sequence->pivot->start_at->format('d/m/Y') }})
                </summary>
    
                @php
                    $nextStep = collect($sequence->pivot->calculated_dates ?? [])
                        ->first(fn ($step) => empty($step['done']));
                @endphp
    
                @if ($nextStep)
                    <div class="ml-4 mt-2 text-sm text-gray-700 dark:text-gray-300">
                        <p>
                            <strong>{{ __('Next step:') }}</strong> 
                            {{ \Carbon\Carbon::parse($nextStep['send_date'])->translatedFormat('l, d F Y') }} – 
                            {{ $nextStep['goal'] ?? __('No goal') }}
                        </p>
                    </div>
                @else
                    <div class="ml-4 mt-2 text-sm text-gray-500 dark:text-gray-400 italic">
                        {{ __('All steps completed.') }}
                    </div>
                @endif

                <div class="ml-4 mt-4 space-y-2">
                    @forelse ($sequence->pivot->calculated_dates as $index => $step)
                    @php $done = !empty($step['done']); @endphp
                
                    <div class="p-3 bg-white dark:bg-gray-900 border rounded-lg shadow-sm">
                        <div class="flex justify-between items-center gap-2">
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                <strong>{{ __('Date:') }}</strong> {{ \Carbon\Carbon::parse($step['send_date'])->translatedFormat('l, d F Y') }}
                            </p>
                
                            <div class="flex items-center gap-4">
                                @if ($done)
                                    <span class="text-sm text-green-600">
                                        {{ __('Done') }}
                                        @if (!empty($step['done_at']))
                                            – {{ \Carbon\Carbon::parse($step['done_at'])->translatedFormat('d/m/Y H:i') }}
                                        @endif
                                    </span>
                                @endif
                
                                <livewire:components.toggle-step-status
                                    :prospectId="$prospect->id"
                                    :sequenceId="$sequence->id"
                                    :stepIndex="$index"
                                    :done="$done"
                                    wire:key="toggle-step-{{ $prospect->id }}-{{ $sequence->id }}-{{ $index }}"
                                />
                            </div>
                        </div>
                
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <strong>{{ __('Goal:') }}</strong> {{ $step['goal'] ?? '-' }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            {{ replace_placeholders($step['message'], $prospect) }}
                        </p>                                                             
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 italic">{{ __('No steps found.') }}</p>
                @endforelse
                
                </div>
            </details>
        @empty
            <p class="text-gray-500 dark:text-gray-400">{{ __('No sequences assigned.') }}</p>
        @endforelse
    </div>
    
    @push('scripts')
    <script>
        Livewire.on('stepMarked', () => {
            Livewire.dispatch('refreshProspect'); // trigger refresh in parent
        });
    </script>
    @endpush

    <div class="flex justify-end mt-6">
        <flux:button as="a" href="{{ route('prospects.edit', $prospect->id) }}" variant="primary">
            {{ __('Edit prospect') }}
        </flux:button>
    </div>
</div>