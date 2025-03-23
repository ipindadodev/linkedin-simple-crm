<section>
    <h2 class="mb-8">{{ __('Prospects') }}</h2>


    <flux:separator class="mt-8 mb-8" />

    
    <x-flux::button as="a" href="{{ route('prospects.create') }}">
        {{ __('Create new') }}
    </x-flux::button>

    <div class="mb-16"></div>

    <livewire:components.table 
        model="App\Models\Prospect"
        editRoute="prospects.edit"
        viewRoute="prospects.show"
        :columns="[
            'id' => __('ID'),
            'first_name' => __('First name'),
            'last_name' => __('Last name'),
            'second_last_name' => __('Second last name'),
            'location_id' => __('Location'),
            'status_id' => __('Status'),
            'industry_id' => __('Industry'),
        ]"
        :sortable="['first_name', 'location_id', 'status_id', 'industry_id']"
        :searchable="['first_name', 'last_name', 'second_last_name']"
        :allowEditing="true"
        :allowDeleting="true"
        :allowViewing="true"
        :relations="[
            'location_id' => ['relation' => 'location', 'field' => 'name'],
            'status_id' => ['relation' => 'status', 'field' => 'name'],    
            'industry_id' => ['relation' => 'industry', 'field' => 'name'],
        ]"
    />
</section>
