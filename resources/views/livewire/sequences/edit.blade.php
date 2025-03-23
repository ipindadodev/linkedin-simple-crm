<article class="w-full mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md">
    <header>
        <flux:heading size="lg" class="mb-8 text-center">
            {{ __('Edit sequence') }}
        </flux:heading>
    </header>

    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="status">
            <strong class="font-bold">{{ session('success') }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold block mb-1">{{ __('Whoops! Something went wrong.') }}</strong>
            <ul class="list-disc list-inside text-sm pl-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="update">
        <section class="grid grid-cols-1 gap-6 mb-6" aria-labelledby="edit-sequence-fields">
            <h2 id="edit-sequence-fields" class="sr-only">{{ __('Edit sequence fields') }}</h2>

            <flux:input wire:model.defer="code" label="{{ __('Code') }}" required />
            <flux:input wire:model.defer="name" label="{{ __('Name') }}" required />
            <flux:textarea wire:model.defer="description" label="{{ __('Description') }}" />
        </section>

        <footer class="flex justify-end mt-8 space-x-4">
            <flux:button as="a" href="{{ route('sequences.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Update') }}
            </flux:button>
        </footer>
    </form>
</article>