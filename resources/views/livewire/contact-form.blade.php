<div class="glass rounded-3xl p-8" x-data="{ submitting: false }">
    @if($success)
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-brand-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-semibold mb-2">Nachricht gesendet!</h3>
            <p class="text-gray-400">Ich melde mich bald zurück.</p>
            <button @click="$wire.success = false" class="mt-4 btn btn-ghost">
                Neue Nachricht senden
            </button>
        </div>
    @else
        <form wire:submit.prevent="submit" @submit="submitting = true">
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                        Name
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        wire:model="name"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition-colors"
                        placeholder="Dein Name"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                        E-Mail
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        wire:model="email"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition-colors"
                        placeholder="deine@email.com"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-300 mb-2">
                        Nachricht
                    </label>
                    <textarea 
                        id="message" 
                        wire:model="message"
                        rows="5"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition-colors resize-none"
                        placeholder="Deine Nachricht..."
                    ></textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="w-full btn btn-primary"
                    :disabled="submitting"
                >
                    <span wire:loading.remove>Nachricht senden</span>
                    <span wire:loading>Sende...</span>
                </button>
            </div>
        </form>
    @endif
</div>
