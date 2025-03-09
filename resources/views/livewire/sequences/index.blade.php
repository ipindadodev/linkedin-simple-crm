<div>
    <h2 class="mb-8">{{ __('Sequences') }}</h2>

    <flux:separator class="mt-8 mb-8" />

    <x-flux::button as="a" href="{{ route('sequences.create') }}">
        {{ __('Create new') }}
    </x-flux::button>

    <div class="mb-16"></div>

    <livewire:components.table 
        model="App\Models\Sequence"
        editRoute="sequences.edit"
        viewRoute="sequences.show"
        :columns="[
            'id' => __('ID'),
            'code' => __('Code'),
            'name' => __('Name'),
            'description' => __('Description'),
        ]"
        :sortable="['name']"
        :searchable="['name', 'code', 'description']"
        :allowEditing="true"
        :allowDeleting="true"
        :allowViewing="true"
    />
</div>
