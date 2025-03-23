@props([
    'on',
])

<aside
    role="status"
    aria-live="polite"
    x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
    x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms
    style="display: none"
    {{ $attributes->merge(['class' => 'text-sm text-green-600 dark:text-green-400']) }}
>
    {{ $slot->isEmpty() ? __('Saved.') : $slot }}
</aside>
