<div>
    <!-- Botón para abrir el modal (Añadir nueva interacción) -->
    <flux:button wire:click="openModal(null)" variant="primary">
        {{ __('Add interaction') }}
    </flux:button>

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-70 backdrop-blur-md">
            <div class="bg-white dark:bg-gray-900 p-8 rounded-xl shadow-2xl w-3xl h-4xl flex flex-col relative">
                
                <!-- Botón de cierre (X) -->
                <button wire:click="closeModal" class="absolute top-4 right-4 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                    ✖
                </button>

                <flux:heading size="lg" class="mb-6 text-center">
                    {{ $interactionId ? __('Edit interaction') : __('New interaction') }}
                </flux:heading>

                <!-- Formulario -->
                <form wire:submit.prevent="save" class="flex flex-col flex-grow">
                    <div class="mb-6">
                        <flux:input wire:model.defer="title" label="{{ __('Title') }}" required />
                        @error('title') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="mb-6 flex-grow">
                        <flux:textarea wire:model.defer="description" label="{{ __('Description') }}" rows="6" />
                        @error('description') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-between mt-6 space-x-4">
                        <div class="text-gray-500 dark:text-gray-400 text-sm">
                            @if($interactionId)
                                {{ __('Created at:') }} {{ $created_at }}<br>
                                {{ __('Updated at:') }} {{ $updated_at }}
                            @endif
                        </div>
                        <div class="flex space-x-4">
                            <flux:button type="button" variant="ghost" wire:click="closeModal">
                                {{ __('Cancel') }}
                            </flux:button>
                            <flux:button type="submit" variant="primary">
                                {{ $interactionId ? __('Update') : __('Save') }}
                            </flux:button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>