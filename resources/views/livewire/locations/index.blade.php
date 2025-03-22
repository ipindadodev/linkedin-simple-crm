<div>
    <h2 class="mb-8">{{ __('Locations') }}</h2>


    <flux:separator class="mt-8 mb-8" />

    
    <x-flux::button as="a" href="{{ route('locations.create') }}">
        {{ __('Create a new location') }}
    </x-flux::button>

    <div class="mb-16"></div>

    <livewire:components.table 
        model="App\Models\ProspectLocation"
        editRoute="locations.edit" 
        :columns="[
            'code' => __('Code'), 
            'name' => __('Name'),
        ]"
        :sortable="['name', 'code']"
        :searchable="['code', 'name']"
        :allowEditing="true"
        :allowDeleting="true"
    />
</div>
