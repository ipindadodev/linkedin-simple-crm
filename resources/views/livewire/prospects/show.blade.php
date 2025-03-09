<div class="w-full h-8xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md overflow-y-auto">
    <flux:heading size="lg" class="mb-6 text-center">{{ __('Prospect details') }}</flux:heading>

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
        <livewire:components.add-interaction />
    </div>

    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow max-h-96 overflow-y-auto">
        @forelse ($prospect->interactions as $interaction)
            <div class="border-b last:border-0 pb-3 mb-3">
                <!-- ✅ Click en el título para abrir el modal de edición -->
                <p class="text-lg font-semibold text-primary-600 dark:text-primary-400 cursor-pointer hover:underline"
                    wire:click="dispatch('editInteraction', [{{ $interaction->id }}])">
                    {{ $interaction->title }}
                </p>
                <p class="text-gray-700 dark:text-gray-300">{{ $interaction->description }}</p>
                
                <!-- ✅ Timestamps de creación y actualización -->
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">
                    {{ __('Created at:') }} {{ $interaction->created_at->format('d/m/Y H:i') }}<br>
                    {{ __('Updated at:') }} {{ $interaction->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400">{{ __('No interactions recorded.') }}</p>
        @endforelse
    </div>

    <!-- Sección de Secuencias -->
    <flux:heading class="mb-4 mt-6">{{ __('Sequences') }}</flux:heading>
    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow">
        @forelse ($prospect->sequences as $sequence)
            <p class="text-gray-700 dark:text-gray-300">
                <strong>{{ __('Name:') }}</strong> {{ $sequence->name }} 
                ({{ __('Added on:') }} {{ $sequence->pivot->included_at->format('d/m/Y') }})
            </p>
        @empty
            <p class="text-gray-500 dark:text-gray-400">{{ __('No sequences assigned.') }}</p>
        @endforelse
    </div>

    <div class="flex justify-end mt-6">
        <flux:button as="a" href="{{ route('prospects.edit', $prospect->id) }}" variant="primary">
            {{ __('Edit prospect') }}
        </flux:button>
    </div>

    <!-- ✅ Modal de interacciones -->
    <livewire:components.add-interaction />
</div>
