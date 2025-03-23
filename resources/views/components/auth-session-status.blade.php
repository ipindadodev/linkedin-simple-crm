@props([
    'status',
])

@if ($status)
    <p {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600', 'role' => 'status', 'aria-live' => 'polite']) }}>
        {{ $status }}
    </p>
@endif
