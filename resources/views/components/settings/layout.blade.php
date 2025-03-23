<div class="flex items-start max-md:flex-col">
    <nav class="mr-10 w-full pb-4 md:w-[220px]" aria-label="{{ __('Settings navigation') }}">
        <flux:navlist>
            <flux:navlist.item :href="route('settings.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
            <flux:navlist.item :href="route('settings.password')" wire:navigate>{{ __('Password') }}</flux:navlist.item>
            <flux:navlist.item :href="route('settings.appearance')" wire:navigate>{{ __('Appearance') }}</flux:navlist.item>
        </flux:navlist>
    </nav>

    <flux:separator class="md:hidden" />

    <section class="flex-1 self-stretch max-md:pt-6" aria-labelledby="settings-heading">
        <flux:heading id="settings-heading">{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </section>
</div>