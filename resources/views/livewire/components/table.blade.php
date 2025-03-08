<div class="overflow-hidden border border-gray-300 dark:border-gray-700 rounded-xl shadow-lg">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 uppercase tracking-wide text-sm">
            <tr>
                @foreach ($columns as $columnKey => $columnLabel)
                    <th 
                        class="p-4 cursor-pointer {{ in_array($columnKey, $sortable) ? 'hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors' : '' }} text-sm font-semibold"
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
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
            @foreach ($data as $row)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    @foreach ($columns as $columnKey => $columnLabel)
                        <td class="p-4 text-gray-700 dark:text-gray-300 text-sm">
                            @if ($columnKey === 'color')
                                <span class="inline-block w-6 h-6 rounded-full border border-gray-300" style="background-color: {{ $row[$columnKey] }};"></span>
                            @else
                                {{ $row[$columnKey] }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="bg-gray-100 dark:bg-gray-800 px-4 py-3 flex justify-between items-center rounded-b-xl">
        <span class="text-sm text-gray-600 dark:text-gray-300">
            {{__('Showing')}} {{ $data->firstItem() }} - {{ $data->lastItem() }} {{__('of')}} {{ $data->total() }}
        </span>
        <div>
            {{ $data->links() }}
        </div>
    </div>
</div>