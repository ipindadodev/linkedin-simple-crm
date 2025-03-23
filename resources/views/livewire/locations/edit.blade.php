<section class="w-full mx-auto bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6">
    <header class="mb-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Edit location') }}
        </h2>
    </header>

    <form wire:submit.prevent="update" aria-label="{{ __('Edit location') }}">
        <fieldset class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <legend class="sr-only">{{ __('Location details') }}</legend>

            <flux:input 
                wire:model.defer="name" 
                label="{{ __('Name') }}" 
                required 
            />

            <flux:input 
                wire:model.defer="code" 
                label="{{ __('Code') }}" 
                required 
            />
        </fieldset>

        <footer class="flex justify-end mt-6 space-x-2">
            <flux:button 
                as="a" 
                href="{{ route('locations.index') }}" 
                variant="ghost"
            >
                {{ __('Cancel') }}
            </flux:button>

            <flux:button 
                type="submit" 
                variant="primary"
            >
                {{ __('Save') }}
            </flux:button>
        </footer>
    </form>
</section>