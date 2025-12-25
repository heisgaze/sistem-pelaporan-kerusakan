@props(['title', 'value', 'icon', 'trend' => null, 'trendUp' => true, 'color' => 'primary'])

@php
$colorClasses = [
    'primary' => 'bg-primary/10 text-primary',
    'success' => 'bg-green-100 text-green-600',
    'warning' => 'bg-amber-100 text-amber-600',
    'info' => 'bg-blue-100 text-blue-600',
    'danger' => 'bg-red-100 text-red-600',
];
@endphp

<div class="bg-card rounded-2xl p-6 border border-border shadow-sm">
    <div class="flex items-start justify-between mb-4">
        <div class="p-3 rounded-xl {{ $colorClasses[$color] ?? $colorClasses['primary'] }}">
            {!! $icon !!}
        </div>
        @if($trend)
            <div class="flex items-center gap-1 text-sm {{ $trendUp ? 'text-green-600' : 'text-red-600' }}">
                @if($trendUp)
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l9.2-9.2M17 17V7m0 10H7"/>
                    </svg>
                @else
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 7l-9.2 9.2M7 7v10m0-10h10"/>
                    </svg>
                @endif
                <span>{{ $trend }}</span>
            </div>
        @endif
    </div>
    <h3 class="text-3xl font-display font-bold text-foreground">{{ $value }}</h3>
    <p class="text-sm text-muted-foreground mt-1">{{ $title }}</p>
</div>