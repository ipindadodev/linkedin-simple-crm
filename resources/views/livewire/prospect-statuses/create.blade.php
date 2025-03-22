<div class="w-full mx-auto bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">
    <flux:heading size="lg" class="mb-6 text-center">{{ __('Create prospect status') }}</flux:heading>

    <form wire:submit="save">
        <!-- Nombre y Código en una fila -->
        <div class="grid grid-cols-2 gap-4">
            <flux:input wire:model.defer="name" label="{{ __('Name') }}" required />
            <flux:input wire:model.defer="code" label="{{ __('Code') }}" required />
        </div>

        <div class="mb-4"></div>

        <!-- Descripción -->
        <flux:textarea wire:model.defer="description" label="{{ __('Description') }}" class="mt-4" required/>

        <!-- Selección de Color -->
        <div class="flex items-center gap-3 mt-4">
            <flux:input wire:model.defer="color" type="color" label="{{ __('Color') }}" class="w-32 h-10 p-1 border rounded-lg shadow-sm" />
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('Choose a status color') }}</span>
        </div>

        <!-- Botones de Acción -->
        <div class="flex justify-end mt-6 space-x-2">
            <flux:button as="a" href="{{ route('prospect-statuses.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</div>
