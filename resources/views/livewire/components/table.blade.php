<div>
    <!-- Barra de búsqueda -->
    @if (!empty($searchable))
        <div class="mb-4 flex justify-between items-center">
            <flux:input 
                icon="magnifying-glass" 
                wire:model.live="search" 
                placeholder="{{ __('Search...') }}" 
                class="w-64" 
            />
        </div>
    @endif

    <div class="overflow-hidden border border-gray-300 dark:border-gray-700 rounded-xl shadow-lg">
        <table class="w-full text-left border-collapse">
            <!-- Encabezado de la tabla -->
            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 uppercase tracking-wide text-sm">
                <tr>
                    @foreach ($columns as $columnKey => $columnLabel)
                        <th 
                            class="p-4 cursor-pointer text-center {{ in_array($columnKey, $sortable) ? 'hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors' : '' }} text-sm font-semibold"
                            wire:click="sort('{{ $columnKey }}')"
                        >
                            {{ $columnLabel }}
                            @if (in_array($columnKey, $sortable))
                                <span class="ml-2">
                                    @if ($sortBy === $columnKey)
                                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                    @else
                                        ↕
                                    @endif
                                </span>
                            @endif
                        </th>
                    @endforeach

                    @if ($allowEditing || $allowDeleting || $allowViewing)
                        <th class="p-4 text-sm font-semibold">{{ __('Actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                @forelse ($data as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        @foreach ($columns as $columnKey => $columnLabel)
                            <td class="p-4 text-gray-700 dark:text-gray-300 text-sm text-center">
                                @if (isset($relations[$columnKey])) 
                                    {{ $row->{$relations[$columnKey]['relation']}->{$relations[$columnKey]['field']} ?? '-' }}
                                @elseif ($columnKey === 'color')
                                    <span class="inline-block w-6 h-6 rounded-full border border-gray-300" style="background-color: {{ $row[$columnKey] }};"></span>
                                @else
                                    {{ $row[$columnKey] }}
                                @endif
                            </td>
                        @endforeach

                        @if ($allowEditing || $allowDeleting || $allowViewing)
                            <td class="p-4 flex gap-2 justify-center">
                                @if ($allowViewing)
                                    <flux:button as="a" href="{{ route($viewRoute, [$row['id']]) }}" size="sm">
                                        {{ __('View') }}
                                    </flux:button>
                                @endif
                                @if ($allowEditing)
                                    <flux:button as="a" href="{{ route($editRoute, [$row['id']]) }}" size="sm">
                                        {{ __('Edit') }}
                                    </flux:button>
                                @endif
                                @if ($allowDeleting)
                                    <button 
                                        type="button"
                                        class="btn btn-danger"
                                        wire:click="triggerDelete('{{ addslashes($model) }}', {{ $row['id'] }})"
                                    >
                                        {{ __('Delete') }}
                                    </button>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 1 }}" class="p-4 text-center text-gray-500 dark:text-gray-400">
                            {{ __('No results found') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($data->hasPages())
        <div class="mt-6">
            {{ $data->links('pagination::tailwind') }}
        </div>
    @endif
</div>
