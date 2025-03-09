<div x-data="{ 
    open: false, 
    search: '', 
    selected: @entangle('selected'), 
    label: '{{ $options[$selected] ?? $placeholder }}' 
}" 
class="relative w-full"
>
<!-- Caja de selección -->
<div 
    @click="open = !open" 
    class="cursor-pointer border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 flex justify-between items-center bg-white dark:bg-gray-900 shadow-sm focus:ring-2 focus:ring-primary-500 transition-all duration-200 overflow-hidden whitespace-nowrap"
>
    <span x-text="label" class="text-gray-800 dark:text-gray-300 truncate w-full"></span>
    <span class="text-gray-600 dark:text-gray-400 ml-2">&#9662;</span>
</div>

<!-- Lista desplegable -->
<div 
    x-show="open" 
    @click.away="open = false" 
    class="absolute w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg mt-1 shadow-lg z-10 transition-all duration-200"
>
    <!-- Campo de búsqueda -->
    <input 
        x-model="search" 
        type="text" 
        placeholder="{{ __('Search...') }}" 
        class="w-full px-3 py-2 border-b border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary-500"
    />

    <!-- Opciones (ahora se ven completas) -->
    <ul class="max-h-40 overflow-y-auto">
        @foreach ($options as $key => $value)
            <li 
                x-show="search === '' || '{{ $value }}'.toLowerCase().includes(search.toLowerCase())"
                @click="selected = '{{ $key }}'; label = '{{ $value }}'; open = false; $wire.set('selected', '{{ $key }}');"
                data-value="{{ $key }}"
                class="px-4 py-2 cursor-pointer hover:bg-primary-100 dark:hover:bg-primary-700 text-gray-800 dark:text-gray-300 transition-colors duration-150 whitespace-normal"
            >
                {{ $value }}
            </li>
        @endforeach
    </ul>
</div>
</div>