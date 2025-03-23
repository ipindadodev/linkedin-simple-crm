<section class="w-full mx-auto bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">
    <flux:heading size="lg" class="mb-6 text-center">
        {{ __('Create prospect status') }}
    </flux:heading>

    <form wire:submit="save">
        <!-- Nombre y Código -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:input wire:model.defer="name" label="{{ __('Name') }}" required />
            <flux:input wire:model.defer="code" label="{{ __('Code') }}" required />
        </div>

        <!-- Descripción -->
        <div class="mt-4">
            <flux:textarea wire:model.defer="description" label="{{ __('Description') }}" required />
        </div>

        <!-- Color -->
        <div class="flex items-center gap-4 mt-4">
            <flux:input wire:model.defer="color" type="color" label="{{ __('Color') }}" class="w-20 h-10" />
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('Choose a status color') }}</span>
        </div>

        <!-- Botones -->
        <div class="flex justify-end mt-6 gap-4">
            <flux:button as="a" href="{{ route('prospect-statuses.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</section>