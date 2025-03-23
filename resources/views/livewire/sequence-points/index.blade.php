<section>
    <h2 class="mb-8">{{ __('Sequence points') }}</h2>

    <flux:separator class="mt-8 mb-8" />

    <x-flux::button as="a" href="{{ route('sequence-points.create') }}">
        {{ __('Create new') }}
    </x-flux::button>

    <div class="mb-16"></div>

    <livewire:components.table 
        model="App\Models\SequencePoint"
        editRoute="sequence-points.edit"
        viewRoute="sequence-points.show"
        :columns="[
            'id' => __('ID'),
            'sequence_id' => __('Sequence'),
            'order' => __('Order'),
            'time_type' => __('Time type'),
            'goal' => __('Goal'),
        ]"
        :sortable="['sequence_id', 'order', 'time_type']"
        :searchable="['message', 'goal']"
        :allowEditing="true"
        :allowDeleting="true"
        :allowViewing="true"
        :relations="[
            'sequence_id' => ['relation' => 'sequence', 'field' => 'name'],
        ]"
    />
</section>
