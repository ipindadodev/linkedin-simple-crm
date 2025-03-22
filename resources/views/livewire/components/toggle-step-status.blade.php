<div>
    @if ($done)
        <button 
            wire:click="toggle"
            class="text-xs text-red-600 hover:text-red-800"
        >
            {{ __('Undo') }}
        </button>
    @else
        <button 
            wire:click="toggle"
            class="text-xs text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded"
        >
            {{ __('Mark as done') }}
        </button>
    @endif
</div>