<div class="w-full mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md">
    <flux:heading size="lg" class="mb-8 text-center">{{ __('Create sequence point') }}</flux:heading>

    {{-- Mostrar los errores --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">{{ __('Whoops! Something went wrong.') }}</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-6 mb-6">
            <flux:select wire:model="sequence_id" label="{{ __('Select sequence') }}" required>
                <flux:select.option value="">{{ __('Select sequence') }}</flux:select.option>
                @foreach ($sequences as $id => $name)
                    <flux:select.option value="{{ $id }}">{{ $name }}</flux:select.option>
                @endforeach
            </flux:select>
            
            <flux:input wire:model.defer="order" label="{{ __('Order') }}" required disabled/>
        </div>

        <flux:textarea wire:model.defer="message" label="{{ __('Message') }}" required />

        <div class="grid grid-cols-3 gap-6 mb-6 mt-6">
            <flux:select wire:model="time_type" placeholder="{{ __('Select time type') }}" label="{{ __('Time type') }}" required>
                <flux:select.option value="daily">{{ __('Daily') }}</flux:select.option>
                <flux:select.option value="weekly">{{ __('Weekly') }}</flux:select.option>
                <flux:select.option value="monthly">{{ __('Monthly') }}</flux:select.option>
                <flux:select.option value="quarterly">{{ __('Quarterly') }}</flux:select.option>
                <flux:select.option value="dynamic">{{ __('Dynamic') }}</flux:select.option>
            </flux:select>

            <flux:select wire:model="day_of_week" placeholder="{{ __('Select day of week') }}" label="{{ __('Day of week') }}" :disabled="$time_type === 'daily' || $time_type === 'dynamic'">
                <flux:select.option value="monday">{{ __('Monday') }}</flux:select.option>
                <flux:select.option value="tuesday">{{ __('Tuesday') }}</flux:select.option>
                <flux:select.option value="wednesday">{{ __('Wednesday') }}</flux:select.option>
                <flux:select.option value="thursday">{{ __('Thursday') }}</flux:select.option>
                <flux:select.option value="friday">{{ __('Friday') }}</flux:select.option>
                <flux:select.option value="saturday">{{ __('Saturday') }}</flux:select.option>
                <flux:select.option value="sunday">{{ __('Sunday') }}</flux:select.option>
            </flux:select>

            <flux:input wire:model.defer="day_of_month" label="{{ __('Day of month') }}" type="number" min="1" max="31" :disabled="$time_type === 'daily' || $time_type === 'dynamic'" />
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="days_after_start" label="{{ __('Days after start') }}" type="number" min="0" :disabled="!($time_type === 'dynamic')" />
            <flux:input wire:model.defer="days_after_previous" label="{{ __('Days after previous') }}" type="number" min="0" :disabled="!($time_type === 'dynamic')" />
        </div>

        <flux:input wire:model.defer="goal" label="{{ __('Goal') }}" />

        <div class="flex justify-end mt-8 space-x-4">
            <flux:button as="a" href="{{ route('sequence-points.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</div>