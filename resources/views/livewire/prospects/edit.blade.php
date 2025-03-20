<div class="w-full mx-auto bg-white dark:bg-gray-900 p-8 rounded-xl shadow-md">
    <flux:heading size="lg" class="mb-8 text-center">{{ __('Edit prospect') }}</flux:heading>

    <form wire:submit.prevent="update">
        <!-- Nombres y Apellidos -->
        <div class="grid grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="first_name" label="{{ __('First name') }}" required />
            <flux:input wire:model.defer="last_name" label="{{ __('Last name') }}" required />
        </div>

        <!-- Segundo Apellido y LinkedIn -->
        <div class="grid grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="second_last_name" label="{{ __('Second last name') }}" />
            <flux:input wire:model.defer="linkedin_url" label="{{ __('LinkedIn URL') }}" type="url" />
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="email" label="{{ __('Email') }}" />
            <flux:input wire:model.defer="phone" label="{{ __('Phone') }}" />
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <flux:input wire:model.defer="company" label="{{ __('Company') }}" />
        </div>

        <!-- Ubicación, Estado e Industria (con búsqueda) -->
        <div class="grid grid-cols-3 gap-6 mb-6">
            <livewire:components.select-search 
                model="location_id"
                :options="$locations"
                selected="{{ $location_id }}"
                placeholder="{{ __('Select location') }}"
            />
        
            <livewire:components.select-search 
                model="status_id"
                :options="$statuses"
                selected="{{ $status_id }}"
                placeholder="{{ __('Select status') }}"
            />
        
            <livewire:components.select-search 
                model="industry_id"
                :options="$industries"
                selected="{{ $industry_id }}"
                placeholder="{{ __('Select industry') }}"
            />
        </div>
        

        <!-- Botones de Acción -->
        <div class="flex justify-end mt-8 space-x-4">
            <flux:button as="a" href="{{ route('prospects.index') }}" variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Update') }}
            </flux:button>
        </div>
    </form>
</div>
