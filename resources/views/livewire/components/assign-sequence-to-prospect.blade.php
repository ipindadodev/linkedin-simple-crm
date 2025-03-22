<div class="mb-4">
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 border border-green-400 p-2 rounded mb-2">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-800 border border-red-400 p-2 rounded mb-2">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="assign" class="flex gap-4 items-end">
        <flux:select wire:model="sequence_id" label="{{ __('Assign sequence') }}">
            <flux:select.option value="">{{ __('Choose...') }}</flux:select.option>
            @foreach ($availableSequences as $id => $name)
                <flux:select.option value="{{ $id }}">{{ $name }}</flux:select.option>
            @endforeach
        </flux:select>

        <flux:button type="submit" variant="primary">
            {{ __('Assign') }}
        </flux:button>
    </form>
</div>