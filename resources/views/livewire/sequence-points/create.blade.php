<section class="w-full mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md">
    <header>
        <flux:heading size="lg" class="mb-8 text-center">{{ __('Create sequence point') }}</flux:heading>
    </header>

    @if ($errors->any())
        <aside class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">{{ __('Whoops! Something went wrong.') }}</strong>
            <ul class="list-disc list-inside mt-2 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </aside>
    @endif

    <form wire:submit.prevent="save">
        @csrf
        <fieldset class="grid grid-cols-2 gap-6 mb-6">
            <legend class="sr-only">{{ __('Sequence point basic info') }}</legend>
            <flux:select wire:model="sequence_id" label="{{ __('Select sequence') }}" required>
                <flux:select.option value="">{{ __('Select sequence') }}</flux:select.option>
                @foreach ($sequences as $id => $name)
                    <flux:select.option value="{{ $id }}">{{ $name }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:input wire:model.defer="order" label="{{ __('Order') }}" required disabled />
        </fieldset>

        <fieldset class="mb-6">
            <legend class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Insert dynamic field') }}
            </legend>
            <div class="flex flex-wrap gap-2">
                @php
                    $placeholders = ['first_name', 'last_name', 'second_last_name', 'email', 'phone', 'company', 'linkedin_url', 'location.name'];
                @endphp
                @foreach ($placeholders as $field)
                    <button type="button"
                        class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-sm rounded hover:bg-gray-300 dark:hover:bg-gray-600"
                        onclick="insertPlaceholder('{{ $field }}')">
                        {{ '{' . $field . '}' }}
                    </button>
                @endforeach
            </div>
        </fieldset>

        <flux:textarea wire:model.defer="message" label="{{ __('Message') }}" required />

        <fieldset class="grid grid-cols-3 gap-6 mb-6 mt-6">
            <legend class="sr-only">{{ __('Timing') }}</legend>

            <flux:select wire:model.live="time_type" label="{{ __('Time type') }}" required>
                <flux:select.option value="daily">{{ __('Daily') }}</flux:select.option>
                <flux:select.option value="weekly">{{ __('Weekly') }}</flux:select.option>
                <flux:select.option value="monthly">{{ __('Monthly') }}</flux:select.option>
                <flux:select.option value="quarterly">{{ __('Quarterly') }}</flux:select.option>
                <flux:select.option value="yearly">{{ __('Yearly') }}</flux:select.option>
                <flux:select.option value="dynamic">{{ __('Dynamic') }}</flux:select.option>
            </flux:select>

            <flux:select wire:model="day_of_week" label="{{ __('Day of week') }}"
                :disabled="!in_array($time_type, ['weekly', 'monthly', 'quarterly', 'yearly'])">
                @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                    <flux:select.option value="{{ $day }}">{{ __(ucfirst($day)) }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input wire:model.defer="day_of_month" label="{{ __('Day of month') }}" type="number" min="1" max="31"
                :disabled="!in_array($time_type, ['monthly', 'quarterly', 'yearly'])" />
        </fieldset>

        <fieldset class="grid grid-cols-2 gap-6 mb-6">
            <legend class="sr-only">{{ __('Dynamic timing') }}</legend>

            <flux:input wire:model.defer="days_after_start" label="{{ __('Days after start') }}" type="number" min="0"
                :disabled="$time_type !== 'dynamic'" />
            <flux:input wire:model.defer="days_after_previous" label="{{ __('Days after previous') }}" type="number" min="0"
                :disabled="$time_type !== 'dynamic'" />
        </fieldset>

        <flux:input wire:model.defer="goal" label="{{ __('Goal') }}" />

        <footer class="flex justify-end mt-8 space-x-4">
            <flux:button as="a" href="{{ route('sequence-points.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </footer>
    </form>
</section>

<script>
    function insertPlaceholder(field) {
        const textarea = document.querySelector('[wire\\:model\\.defer="message"]');
        if (!textarea) return;

        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;

        const placeholder = `{\${${field}}}`;

        textarea.value = text.slice(0, start) + placeholder + text.slice(end);
        textarea.dispatchEvent(new Event('input')); // Actualiza Livewire
        textarea.focus();
        textarea.selectionStart = textarea.selectionEnd = start + placeholder.length;
    }
</script>