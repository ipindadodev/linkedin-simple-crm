<div class="w-full mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md">
    <flux:heading size="lg" class="mb-8 text-center">{{ __('Create Sequence') }}</flux:heading>

    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 gap-6 mb-6">
            <flux:input wire:model.defer="code" label="{{ __('Code') }}" required />
            <flux:input wire:model.defer="name" label="{{ __('Name') }}" required />
            <flux:textarea wire:model.defer="description" label="{{ __('Description') }}" />
        </div>

        <div class="flex justify-end mt-8 space-x-4">
            <flux:button as="a" href="{{ route('sequences.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</div>