<div role="group" aria-label="{{ __('Toggle step status') }}">
    @if ($done)
        <button 
            type="button"
            wire:click="toggle"
            class="text-xs text-red-600 hover:text-red-800 underline focus:outline-none focus:ring-2 focus:ring-red-300 rounded"
            aria-pressed="true"
        >
            {{ __('Undo') }}
        </button>
    @else
        <button 
            type="button"
            wire:click="toggle"
            class="text-xs text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded focus:outline-none focus:ring-2 focus:ring-green-300"
            aria-pressed="false"
        >
            {{ __('Mark as done') }}
        </button>
    @endif
</div>