<section class="w-full h-8xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md overflow-y-auto">
    <header>
        <flux:heading size="lg" class="mb-6 text-center">{{ __('Prospect details') }}</flux:heading>
    </header>

    @if ($nextStep)
        <aside class="mb-6 text-sm text-gray-700 dark:text-gray-300 bg-yellow-50 dark:bg-yellow-900 border border-yellow-300 dark:border-yellow-700 p-4 rounded-lg shadow">
            <strong>{{ __('Next step to execute:') }}</strong><br>
            {{ \Carbon\Carbon::parse($nextStep['send_date'])->translatedFormat('l, d F Y') }}
            – {{ $nextStep['goal'] ?? __('No goal') }}
            <span class="block mt-1 italic text-gray-500 dark:text-gray-400">
                ({{ __('In sequence:') }} {{ $nextStep['sequence_name'] }})
            </span>
        </aside>
    @else
        <p class="mb-6 text-sm italic text-green-700 dark:text-green-300">
            {{ __('All sequences completed. No pending steps.') }}
        </p>
    @endif

    <!-- Información general -->
    <section aria-labelledby="general-info" class="grid grid-cols-3 gap-6 mb-6">
        @php
            $fields = [
                'first_name' => $prospect->first_name,
                'last_name' => $prospect->last_name,
                'second_last_name' => $prospect->second_last_name,
                'linkedin_url' => $prospect->linkedin_url,
                'email' => $prospect->email,
                'phone' => $prospect->phone,
                'location' => $prospect->location->name ?? '-',
                'status' => $prospect->status->name ?? '-',
                'industry' => $prospect->industry->name ?? '-',
            ];
        @endphp

        @foreach ($fields as $label => $value)
            <article>
                <p class="text-gray-600 dark:text-gray-300 font-semibold">{{ __(ucwords(str_replace('_', ' ', $label))) }}</p>
                @if ($label === 'linkedin_url')
                    <a href="{{ $value }}" target="_blank" class="text-blue-500 hover:underline">
                        {{ __('View profile') }}
                    </a>
                @else
                    <span class="text-gray-900 dark:text-gray-100">{{ $value }}</span>
                @endif
            </article>
        @endforeach
    </section>

    <!-- Interacciones -->
    <section aria-labelledby="interactions">
        <div class="flex justify-between items-center mb-4">
            <flux:heading>{{ __('Interactions') }}</flux:heading>
            <livewire:components.add-interaction :prospectId="$prospect->id" />
        </div>

        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow max-h-96 overflow-y-auto">
            @forelse ($prospect->interactions->sortByDesc('created_at') as $interaction)
                <article class="pb-3 mb-3">
                    <h3 class="text-lg font-semibold text-primary-600 dark:text-primary-400 cursor-pointer hover:underline"
                        wire:click="$dispatch('editInteraction', [{{ $interaction->id }}])">
                        {{ $interaction->title }}
                    </h3>
                    <span class="text-gray-500 dark:text-gray-400 text-[0.9rem]/6 mt-2 block">
                        <span class="text-cyan-500">{{ __('Created at:') }}</span>
                        {{ $interaction->created_at->translatedFormat('l, d \d\e F \d\e Y \a \l\a\s H:i') }}
                        @if ($interaction->updated_at->gt($interaction->created_at))
                            –
                            <span class="text-indigo-500">{{ __('Updated at:') }}</span>
                            {{ $interaction->updated_at->translatedFormat('l, d \d\e F \d\e Y \a \l\a\s H:i') }}
                        @endif
                    </span>
                    <p class="text-gray-700 dark:text-gray-300">{{ $interaction->description }}</p>
                </article>

                @if (!$loop->last)
                    <flux:separator variant="subtle" />
                @endif
            @empty
                <p class="text-gray-500 dark:text-gray-400">{{ __('No interactions recorded.') }}</p>
            @endforelse
        </div>
    </section>

    <!-- Secciones y pasos -->
    <section aria-labelledby="sequences" class="mt-8">
        <flux:heading class="mb-4">{{ __('Sequences') }}</flux:heading>

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
                        <p class="ml-4 mt-2 text-sm text-gray-700 dark:text-gray-300">
                            <strong>{{ __('Next step:') }}</strong>
                            {{ \Carbon\Carbon::parse($nextStep['send_date'])->translatedFormat('l, d F Y') }} –
                            {{ $nextStep['goal'] ?? __('No goal') }}
                        </p>
                    @else
                        <p class="ml-4 mt-2 text-sm italic text-gray-500 dark:text-gray-400">
                            {{ __('All steps completed.') }}
                        </p>
                    @endif

                    <div class="ml-4 mt-4 space-y-2">
                        @forelse ($sequence->pivot->calculated_dates as $index => $step)
                            @php $done = !empty($step['done']); @endphp

                            <article class="p-3 bg-white dark:bg-gray-900 border rounded-lg shadow-sm">
                                <header class="flex justify-between items-center gap-2 mb-1">
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
                                </header>

                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    <strong>{{ __('Goal:') }}</strong> {{ $step['goal'] ?? '-' }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    {{ replace_placeholders($step['message'], $prospect) }}
                                </p>
                            </article>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 italic">{{ __('No steps found.') }}</p>
                        @endforelse
                    </div>
                </details>
            @empty
                <p class="text-gray-500 dark:text-gray-400">{{ __('No sequences assigned.') }}</p>
            @endforelse
        </div>
    </section>

    <footer class="flex justify-end mt-6">
        <flux:button as="a" href="{{ route('prospects.edit', $prospect->id) }}" variant="primary">
            {{ __('Edit prospect') }}
        </flux:button>
    </footer>

    @push('scripts')
        <script>
            Livewire.on('stepMarked', () => {
                Livewire.dispatch('refreshProspect');
            });
        </script>
    @endpush
</section>