<div class="w-full mx-auto bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
        {{ __('Edit location') }}
    </h2>

    <form wire:submit.prevent="update">
        <!-- Nombre -->
        <flux:input wire:model.defer="name" label="{{ __('Name') }}" required class="mb-4" />

        <!-- Código -->
        <flux:input wire:model.defer="code" label="{{ __('Code') }}" required class="mb-4" />

        <!-- Botones -->
        <div class="flex justify-end gap-4">
            <flux:button as="a" href="{{ route('locations.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</div>