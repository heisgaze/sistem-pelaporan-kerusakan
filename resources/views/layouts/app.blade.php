<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Lapor Fasilitas Tel-U</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-background text-foreground font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            @include('components.navbar')

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-muted/30">
                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>