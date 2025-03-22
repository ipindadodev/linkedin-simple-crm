<div class="w-full mx-auto bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">
    <flux:heading size="lg" class="mb-6 text-center">{{ __('Create location') }}</flux:heading>

    <form wire:submit="save">
        <div class="grid grid-cols-2 gap-4">
            <flux:input wire:model.defer="name" label="{{ __('Name') }}" required />
            <flux:input wire:model.defer="code" label="{{ __('Code') }}" required />
        </div>

        <!-- Botones -->
        <div class="flex justify-end mt-6 space-x-2">
            <flux:button as="a" href="{{ route('locations.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</div>
