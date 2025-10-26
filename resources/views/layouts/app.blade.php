<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ isDark: true }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Adrian Abdullahu - Portfolio' }}</title>
    <meta name="description" content="{{ $description ?? 'Modern Portfolio Website - Web Development, UI Design, Performance Engineering' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass" x-data="{ open: false }">
        <div class="container-custom">
            <div class="flex items-center justify-between h-20">
                <a href="#home" class="text-2xl font-bold text-gradient">
                    Adrian Abdullahu
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-300 hover:text-brand-400 transition-colors">Home</a>
                    <a href="#projects" class="text-gray-300 hover:text-brand-400 transition-colors">Projekte</a>
                    <a href="#about" class="text-gray-300 hover:text-brand-400 transition-colors">Über mich</a>
                    <a href="#contact" class="text-gray-300 hover:text-brand-400 transition-colors">Kontakt</a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden text-gray-300 hover:text-brand-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="open && 'hidden'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="!open && 'hidden'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" @click.outside="open = false" x-transition class="md:hidden pb-6 space-y-4">
                <a href="#home" class="block text-gray-300 hover:text-brand-400">Home</a>
                <a href="#projects" class="block text-gray-300 hover:text-brand-400">Projekte</a>
                <a href="#about" class="block text-gray-300 hover:text-brand-400">Über mich</a>
                <a href="#contact" class="block text-gray-300 hover:text-brand-400">Kontakt</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative bg-gray-950 py-12 border-t border-gray-800">
        <div class="container-custom">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-gray-400">&copy; {{ date('Y') }} Adrian Abdullahu. Alle Rechte vorbehalten.</p>
                <div class="flex space-x-6">
                    <a href="https://github.com/adrian1921677" target="_blank" rel="noopener" class="text-gray-400 hover:text-brand-400 transition-colors">
                        GitHub
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="text-gray-400 hover:text-brand-400 transition-colors">
                        LinkedIn
                    </a>
                    <a href="mailto:adrian@example.com" class="text-gray-400 hover:text-brand-400 transition-colors">
                        E-Mail
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
