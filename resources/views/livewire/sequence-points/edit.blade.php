<div class="w-full mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md">
    <flux:heading size="lg" class="mb-8 text-center">{{ __('Edit sequence point') }}</flux:heading>

    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">{{ session('success') }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">{{ __('Whoops! Something went wrong.') }}</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="update">
        <div class="grid grid-cols-2 gap-6 mb-6">
            <flux:select wire:model="sequence_id" label="{{ __('Select sequence') }}" required>
                <flux:select.option value="">{{ __('Select sequence') }}</flux:select.option>
                @foreach ($sequences as $id => $name)
                    <flux:select.option value="{{ $id }}">{{ $name }}</flux:select.option>
                @endforeach
            </flux:select>
            
            <flux:input wire:model.defer="order" label="{{ __('Order') }}" required />
        </div>

        <flux:textarea wire:model.defer="message" label="{{ __('Message') }}" required />

        <div class="grid grid-cols-3 gap-6 mb-6 mt-6">
            <flux:select wire:model="time_type" label="{{ __('Time type') }}" required>
                <flux:select.option value="daily">{{ __('Daily') }}</flux:select.option>
                <flux:select.option value="weekly">{{ __('Weekly') }}</flux:select.option>
                <flux:select.option value="monthly">{{ __('Monthly') }}</flux:select.option>
                <flux:select.option value="quarterly">{{ __('Quarterly') }}</flux:select.option>
                <flux:select.option value="dynamic">{{ __('Dynamic') }}</flux:select.option>
            </flux:select>

            <flux:select wire:model="day_of_week" label="{{ __('Day of week') }}" 
                :disabled="$time_type === 'daily' || $time_type === 'dynamic'">
                <flux:select.option value="monday">{{ __('Monday') }}</flux:select.option>
                <flux:select.option value="tuesday">{{ __('Tuesday') }}</flux:select.option>
                <flux:select.option value="wednesday">{{ __('Wednesday') }}</flux:select.option>
                <flux:select.option value="thursday">{{ __('Thursday') }}</flux:select.option>
                <flux:select.option value="friday">{{ __('Friday') }}</flux:select.option>
                <flux:select.option value="saturday">{{ __('Saturday') }}</flux:select.option>
                <flux:select.option value="sunday">{{ __('Sunday') }}</flux:select.option>
            </flux:select>
        </div>

        <flux:input wire:model.defer="goal" label="{{ __('Goal') }}" />

        <div class="flex justify-end mt-8 space-x-4">
            <flux:button as="a" href="{{ route('sequence-points.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Update') }}
            </flux:button>
        </div>
    </form>
</div>