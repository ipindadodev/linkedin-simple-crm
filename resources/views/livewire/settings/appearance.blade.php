<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public string $language;

    public function mount()
    {
        App::setLocale(session('locale')); // fuerza el idioma al montar el componente
    }

};
?>

<div class="flex flex-col items-start">
    @include('partials.settings-heading')
    <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">

        <!-- Tema -->
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
        </flux:radio.group>

        <div class="mt-8"></div>
        <flux:separator />
        <div class="mb-8"></div>

        <!-- Formulario solo para idioma -->
        <form method="POST" action="{{ route('settings.langChange') }}" x-data>
            @csrf
        
            <flux:select name="language" x-on:change="$el.form.submit()" placeholder="{{ __('Choose language...') }}">
                <flux:select.option value="en" :selected="`{{ app()->getLocale() }}` === 'en'">{{ __('English') }}</flux:select.option>
                <flux:select.option value="es" :selected="`{{ app()->getLocale() }}` === 'es'">{{ __('Spanish') }}</flux:select.option>
                <flux:select.option value="gl" :selected="`{{ app()->getLocale() }}` === 'ga'">{{ __('Galician') }}</flux:select.option>
                <flux:select.option value="ca" :selected="`{{ app()->getLocale() }}` === 'ca'">{{ __('Catalan') }}</flux:select.option>
                <flux:select.option value="eu" :selected="`{{ app()->getLocale() }}` === 'eu'">{{ __('Basque') }}</flux:select.option>
                <flux:select.option value="es_co" :selected="`{{ app()->getLocale() }}` === 'es_co'">{{ __('Spanish (Colombia)') }}</flux:select.option>
                <flux:select.option value="es_ar" :selected="`{{ app()->getLocale() }}` === 'es_ar'">{{ __('Spanish (Argentina)') }}</flux:select.option>
                <flux:select.option value="es_cl" :selected="`{{ app()->getLocale() }}` === 'es_cl'">{{ __('Spanish (Chile)') }}</flux:select.option>
                <flux:select.option value="es_mx" :selected="`{{ app()->getLocale() }}` === 'es_mx'">{{ __('Spanish (Mexico)') }}</flux:select.option>
                <flux:select.option value="es_pe" :selected="`{{ app()->getLocale() }}` === 'es_pe'">{{ __('Spanish (Peru)') }}</flux:select.option>
                <flux:select.option value="es_us" :selected="`{{ app()->getLocale() }}` === 'es_us'">{{ __('Spanish (United States)') }}</flux:select.option>
            </flux:select>
        </form>
        
        @if (app()->getLocale() !== session('locale'))
            <p class="text-red-600">⚠️ El idioma de la app no coincide con la sesión ({{ app()->getLocale() }} ≠ {{ session('locale') }})</p>
        @endif

    </x-settings.layout>
</div>