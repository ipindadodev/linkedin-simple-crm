<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public string $language;

    public function mount()
    {
        $this->language = Auth::user()->language ?? config('app.locale');
    }

    public function saveLanguage()
    {
        $user = Auth::user();
        $user->update(['language' => $this->language]);
        
        session()->put('locale', $this->language);

        return redirect(request()->header('Referer') ?? '/');
    }
};
?>

<div class="flex flex-col items-start">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
        <!-- Tema de la aplicación -->
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
        </flux:radio.group>

        <div class="mt-8"> </div>

        <flux:separator />

        <div class="mb-8"> </div>

        <!-- Selector de idioma en Flux -->
        <flux:select wire:model="language" wire:change="saveLanguage" placeholder="{{ __('Choose language...') }}">
            <flux:select.option value="en">{{ __('English') }}</flux:select.option>
            <flux:select.option value="es">{{ __('Spanish') }}</flux:select.option>
        </flux:select>

    </x-settings.layout>
</div>
