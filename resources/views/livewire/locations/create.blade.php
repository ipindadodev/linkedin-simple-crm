<section class="w-full mx-auto bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">
    <header class="mb-6 text-center">
        <flux:heading size="lg">
            {{ __('Create location') }}
        </flux:heading>
    </header>

    <form wire:submit="save" aria-label="{{ __('Create location') }}">
        @csrf
        <fieldset class="grid grid-cols-2 gap-4">
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