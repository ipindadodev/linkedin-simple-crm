<section>
    <header class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
            {{ __('Locations') }}
        </h2>
    </header>

    <flux:separator class="my-8" />

    <div class="mb-6">
        <x-flux::button as="a" href="{{ route('locations.create') }}">
            {{ __('Create a new location') }}
        </x-flux::button>
    </div>

    <div class="mb-16">
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
</section>