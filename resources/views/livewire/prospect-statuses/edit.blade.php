<div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
        {{ __('Edit prospect status') }}
    </h2>

    <form wire:submit.prevent="update">
        <!-- Nombre -->
        <flux:input wire:model.defer="name" label="{{ __('Name') }}" required class="mb-4" />

        <!-- Código -->
        <flux:input wire:model.defer="code" label="{{ __('Code') }}" required class="mb-4" />

        <!-- Descripción -->
        <flux:textarea wire:model.defer="description" label="{{ __('Description') }}" class="mb-4" />

        <!-- Color -->
        <div class="flex items-center gap-4 mb-6">
            <flux:input wire:model.defer="color" type="color" label="{{ __('Color') }}" class="w-16 h-10" />
            <span class="text-gray-600 dark:text-gray-400">{{ __('Choose a status color') }}</span>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4">
            <flux:button as="a" href="{{ route('prospect-statuses.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" color="primary">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</div>
