<section class="mb-4" aria-labelledby="assign-sequence-section">
    <!-- Mensajes de estado -->
    @if (session()->has('success'))
        <p 
            class="bg-green-100 text-green-800 border border-green-400 p-2 rounded mb-2"
            role="status"
        >
            {{ session('success') }}
        </p>
    @endif

    @if (session()->has('error'))
        <p 
            class="bg-red-100 text-red-800 border border-red-400 p-2 rounded mb-2"
            role="alert"
        >
            {{ session('error') }}
        </p>
    @endif

    <!-- Formulario -->
    <form wire:submit.prevent="assign" class="flex gap-4 items-end" aria-describedby="assign-sequence-description">
        <fieldset class="flex-1">
            <legend id="assign-sequence-section" class="sr-only">
                {{ __('Assign sequence to prospect') }}
            </legend>

            <flux:select wire:model="sequence_id" label="{{ __('Assign sequence') }}">
                <flux:select.option value="">{{ __('Choose...') }}</flux:select.option>
                @foreach ($availableSequences as $id => $name)
                    <flux:select.option value="{{ $id }}">{{ $name }}</flux:select.option>
                @endforeach
            </flux:select>
        </fieldset>

        <flux:button type="submit" variant="primary">
            {{ __('Assign') }}
        </flux:button>
    </form>
</section>