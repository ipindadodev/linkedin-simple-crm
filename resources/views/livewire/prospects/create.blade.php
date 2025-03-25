<section class="w-full mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md">
    <flux:heading size="lg" class="mb-8 text-center">{{ __('Create prospect') }}</flux:heading>

    <form wire:submit.prevent="save">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="first_name" label="{{ __('First name') }}" required />
            <flux:input wire:model.defer="last_name" label="{{ __('Last name') }}" required />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="second_last_name" label="{{ __('Second last name') }}" />
            <flux:input wire:model.defer="linkedin_url" label="{{ __('LinkedIn URL') }}" type="url" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="email" label="{{ __('Email') }}" />
            <flux:input wire:model.defer="phone" label="{{ __('Phone') }}" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="company" label="{{ __('Company') }}" />
            <flux:input wire:model.defer="web" label="{{ __('Web') }}" />
        </div>

        <!-- Selects con búsqueda -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <livewire:components.select-search 
                model="location_id"
                :options="$locations"
                selected="{{ old('location_id', $location_id ?? '') }}"
                placeholder="{{ __('Select location') }}"
            />
            <livewire:components.select-search 
                model="status_id"
                :options="$statuses"
                selected="{{ old('status_id', $status_id ?? '') }}"
                placeholder="{{ __('Select status') }}"
            />
            <livewire:components.select-search 
                model="industry_id"
                :options="$industries"
                selected="{{ old('industry_id', $industry_id ?? '') }}"
                placeholder="{{ __('Select industry') }}"
            />
        </div>

        <div class="flex justify-end mt-8 gap-4">
            <flux:button as="a" href="{{ route('prospects.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</section>