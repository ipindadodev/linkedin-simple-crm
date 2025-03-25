<article class="w-full mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md">
    <header>
        <flux:heading size="lg" class="mb-8 text-center">
            {{ __('Create sequence') }}
        </flux:heading>
    </header>

    <form wire:submit.prevent="save">
        @csrf
        <section class="grid grid-cols-1 gap-6 mb-6" aria-labelledby="sequence-fields">
            <h2 id="sequence-fields" class="sr-only">{{ __('Sequence fields') }}</h2>

            <flux:input wire:model.defer="code" label="{{ __('Code') }}" required />
            <flux:input wire:model.defer="name" label="{{ __('Name') }}" required />
            <flux:textarea wire:model.defer="description" label="{{ __('Description') }}" />
        </section>

        <footer class="flex justify-end mt-8 space-x-4">
            <flux:button as="a" href="{{ route('sequences.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </footer>
    </form>
</article>
