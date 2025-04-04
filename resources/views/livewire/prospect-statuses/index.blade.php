<section>
    <h2 class="mb-8">{{ __('Prospect statuses') }}</h2>


    <flux:separator class="mt-8 mb-8" />

    
    <x-flux::button as="a" href="{{ route('prospect-statuses.create') }}">
        {{ __('Create new') }}
    </x-flux::button>

    <div class="mb-16"></div>

    <livewire:components.table 
        model="App\Models\ProspectStatus"
        editRoute="prospect-statuses.edit" 
        :columns="[
            'code' => __('Code'), 
            'name' => __('Name'), 
            'description' => __('Description'), 
            'color' => __('Color')
        ]"
        :sortable="['name', 'code']"
        :searchable="['code', 'name', 'description']"
        :allowEditing="true"
        :allowDeleting="true"
    />
</section>
