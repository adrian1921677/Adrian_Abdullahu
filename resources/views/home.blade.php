@extends('layouts.app')

@section('content')
    <!-- Hero Section with 3D Background -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- 3D Canvas Background -->
        <canvas id="three-canvas" class="absolute inset-0 pointer-events-none"></canvas>
        
        <!-- Content -->
        <div class="relative z-10 container-custom text-center" data-animate>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-slide-up">
                <span class="text-gradient">Adrian Abdullahu</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8 animate-slide-up" style="animation-delay: 0.2s">
                Web Developer & UI Designer
            </p>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto mb-12 animate-slide-up" style="animation-delay: 0.4s">
                Performance, Accessibility & Modern Web Technologies
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-slide-up" style="animation-delay: 0.6s">
                <a href="#projects" class="btn btn-primary">Meine Projekte</a>
                <a href="#contact" class="btn btn-ghost">Kontakt aufnehmen</a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section bg-gray-950/50">
        <div class="container-custom">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gradient" data-animate>
                Meine Projekte
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    [
                        'title' => 'E-Commerce Dashboard',
                        'description' => 'React-basiertes Admin-Panel mit real-time Analytics',
                        'tags' => ['React', 'TypeScript', 'D3.js'],
                        'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600'
                    ],
                    [
                        'title' => 'Mobile Banking App',
                        'description' => 'Native iOS/Android App mit biometrischer Authentifizierung',
                        'tags' => ['React Native', 'Node.js', 'PostgreSQL'],
                        'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=600'
                    ],
                    [
                        'title' => 'Performance Monitor',
                        'description' => 'Real-time Web Vitals Tracking mit automatischen Alerts',
                        'tags' => ['Vue.js', 'Web Vitals', 'WebSockets'],
                        'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=600'
                    ]
                ] as $project)
                <article class="card" data-animate data-stagger>
                    <div class="relative h-48 mb-4 rounded-xl overflow-hidden">
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-brand-400">{{ $project['title'] }}</h3>
                    <p class="text-gray-400 mb-4">{{ $project['description'] }}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($project['tags'] as $tag)
                            <span class="px-3 py-1 bg-brand-900/30 text-brand-300 rounded-full text-sm">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <a href="#" class="btn btn-ghost w-full">Details ansehen →</a>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-12 text-gradient" data-animate>
                    Über mich
                </h2>
                
                <div class="glass rounded-3xl p-8 md:p-12" data-animate>
                    <p class="text-lg text-gray-300 mb-8 leading-relaxed">
                        Frontend-Entwickler mit Fokus auf Performance und User Experience. 
                        Spezialisiert auf moderne Web-Technologien und saubere, wartbare Codebases.
                    </p>
                    
                    <div class="grid grid-cols-3 gap-8 mb-12" data-animate>
                        <div class="text-center">
                            <div class="text-5xl font-bold text-brand-400 mb-2">5+</div>
                            <div class="text-gray-400">Jahre Erfahrung</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-bold text-brand-400 mb-2">50+</div>
                            <div class="text-gray-400">Projekte</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-bold text-brand-400 mb-2">98</div>
                            <div class="text-gray-400">Lighthouse</div>
                        </div>
                    </div>

                    <div data-animate>
                        <h3 class="text-2xl font-semibold mb-4 text-brand-400">Technologien</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['JavaScript/TypeScript', 'React/Vue.js', 'Laravel/PHP', 'Node.js', 'CSS/SCSS', 'Web Performance', 'Accessibility'] as $skill)
                                <span class="px-4 py-2 bg-gray-700/50 text-gray-200 rounded-lg">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section bg-gray-950/50">
        <div class="container-custom">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gradient" data-animate>
                Lass uns zusammenarbeiten
            </h2>
            
            <div class="max-w-2xl mx-auto">
                <livewire:contact-form />
            </div>

            <div class="mt-12 flex justify-center space-x-6" data-animate>
                <a href="mailto:adrian@example.com" class="flex items-center space-x-2 text-gray-400 hover:text-brand-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>adrian@example.com</span>
                </a>
                <a href="https://github.com/adrian1921677" target="_blank" rel="noopener" class="flex items-center space-x-2 text-gray-400 hover:text-brand-400 transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.26.825-.585 0-.29-.015-1.26-.015-2.28-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.515.12-3.15 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.635.24 2.85.12 3.15.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.585A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"></path>
                    </svg>
                    <span>GitHub</span>
                </a>
            </div>
        </div>
    </section>
@endsection
