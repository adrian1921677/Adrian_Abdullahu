# Adrian Abdullahu - Portfolio

Eine moderne, hochperformante Portfolio-Website mit dem TALL-Stack (TailwindCSS, Alpine.js, Laravel, Livewire) plus Three.js für 3D-Animationen und Lenis für sanftes Scrolling.

## 🚀 Features

- **TALL Stack**: Modernes Full-Stack-Framework mit Laravel und Livewire
- **Three.js**: Interaktive 3D-Particle-Animationen im Hintergrund
- **Lenis**: Sanftes, butterweiches Scrolling
- **Alpine.js**: Lightweight JavaScript für Interaktivität
- **TailwindCSS**: Utility-first CSS Framework
- **Responsive Design**: Perfekt auf allen Geräten
- **Performance**: Optimiert für Speed und Lighthouse-Scores
- **Accessibility**: Barrierefreies Design

## 🛠️ Technologien

- Laravel 11
- Livewire 3
- Alpine.js 3
- TailwindCSS 3
- Three.js
- Lenis Smooth Scroll
- Vite

## 📦 Installation

### Voraussetzungen

- PHP 8.2+
- Composer
- Node.js & npm

### Setup

1. **Dependencies installieren:**

```bash
composer install
npm install
```

2. **Umgebungsvariablen konfigurieren:**

```bash
cp .env.example .env
php artisan key:generate
```

3. **Development Server starten:**

```bash
# Terminal 1: Laravel
php artisan serve

# Terminal 2: Vite
npm run dev
```

4. **Projekt besuchen:**
   - Öffne http://localhost:8000 im Browser

## 🏗️ Build für Production

```bash
npm run build
```

## 📁 Projektstruktur

```
├── app/
│   └── Livewire/         # Livewire Komponenten
├── resources/
│   ├── css/              # TailwindCSS
│   ├── js/               # JavaScript (Alpine.js, Three.js, Lenis)
│   └── views/            # Blade Templates
├── routes/               # Web Routes
├── public/               # Öffentliche Assets
└── config/               # Konfigurationsdateien
```

## 🎨 Anpassung

### Farben ändern

Bearbeite `tailwind.config.js`:

```js
colors: {
    brand: {
        // Deine Farben
    }
}
```

### Inhalte anpassen

- **Hero-Section**: `resources/views/home.blade.php`
- **Projekte**: Daten in `home.blade.php` anpassen
- **3D-Animation**: `resources/js/three-scene.js`

## 📄 Lizenz

MIT License - fühle dich frei, das Projekt zu verwenden!

## 👤 Autor

Adrian Abdullahu

---

Made with ❤️ using the TALL Stack