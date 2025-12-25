@props([
    'type' => 'text',
    'error' => null,
])

@php
$base = 'flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background
file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground
placeholder:text-muted-foreground
focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2
disabled:cursor-not-allowed disabled:opacity-50 md:text-sm';

$errorClass = $error ? 'border-destructive focus-visible:ring-destructive' : '';

$classes = trim($base.' '.$errorClass);
@endphp

<input
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
