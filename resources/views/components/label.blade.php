@props([
    'for' => null,
])

@php
$base = 'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70';
@endphp

<label
    @if($for) for="{{ $for }}" @endif
    {{ $attributes->merge(['class' => $base]) }}
>
    {{ $slot }}
</label>
