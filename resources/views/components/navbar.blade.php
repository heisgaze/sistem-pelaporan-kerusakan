<header class="h-16 border-b border-border bg-card flex items-center justify-between px-6">
    <div>
        <h1 class="font-display font-bold text-lg text-foreground">@yield('page-title', 'Dashboard')</h1>
        <p class="text-sm text-muted-foreground">@yield('page-subtitle', '')</p>
    </div>
    
    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <button class="p-2 text-muted-foreground hover:text-foreground transition-colors relative">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            @if($unreadNotifications > 0)
                <span class="absolute -top-1 -right-1 h-5 w-5 bg-primary text-white text-xs rounded-full flex items-center justify-center">
                    {{ $unreadNotifications }}
                </span>
            @endif
        </button>
    </div>
</header>