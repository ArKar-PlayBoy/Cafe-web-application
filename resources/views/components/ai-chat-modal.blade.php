<div 
    id="ai-chat-modal"
    class="fixed bottom-24 right-6 z-50 w-96 max-w-[calc(100vw-3rem)] bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform transition-all duration-300 hidden flex flex-col"
    style="max-height: 600px;"
>
    <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-500 to-green-600 rounded-t-2xl">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-white">AI Barista</h3>
                <p class="text-xs text-white/80">Weather & mood • No API key</p>
            </div>
        </div>
        <button id="ai-chat-close" class="text-white/80 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div id="ai-weather-display" class="p-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-3">
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300" id="ai-location">Loading weather...</p>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-2xl" id="ai-weather-icon">☀️</span>
                    <div>
                        <p class="text-lg font-bold text-gray-800 dark:text-gray-100" id="ai-temperature">--°C</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400" id="ai-condition">--</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="ai-chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4" style="max-height: 350px; min-height: 200px;">
        <div class="flex gap-3">
            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl rounded-tl-sm px-4 py-2 max-w-[80%]">
                <p class="text-sm text-gray-700 dark:text-gray-300">Hi! I'm your Barista. Tell me how you feel or what you're in the mood for — I'll recommend drinks based on the weather, time of day, and your mood.</p>
            </div>
        </div>
    </div>

    <div id="ai-quick-suggestions" class="px-4 pb-2 flex gap-2 flex-wrap">
        <button type="button" class="quick-suggestion text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-green-100 dark:hover:bg-green-900/30 text-gray-700 dark:text-gray-300 rounded-full transition-colors" data-query="I'm tired">😴 Tired</button>
        <button type="button" class="quick-suggestion text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-green-100 dark:hover:bg-green-900/30 text-gray-700 dark:text-gray-300 rounded-full transition-colors" data-query="Something sweet">🍰 Sweet</button>
        <button type="button" class="quick-suggestion text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-green-100 dark:hover:bg-green-900/30 text-gray-700 dark:text-gray-300 rounded-full transition-colors" data-query="Need energy">⚡ Energy</button>
        <button type="button" class="quick-suggestion text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-green-100 dark:hover:bg-green-900/30 text-gray-700 dark:text-gray-300 rounded-full transition-colors" data-query="I want to relax">🍵 Relax</button>
    </div>

    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <form id="ai-chat-form" class="flex gap-2">
            <input 
                type="text" 
                id="ai-chat-input"
                placeholder="Tell me what you want..."
                class="flex-1 px-4 py-2.5 bg-gray-100 dark:bg-gray-700 border-0 rounded-full text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none transition-all"
            >
            <button 
                type="submit"
                class="w-10 h-10 bg-green-600 hover:bg-green-700 text-white rounded-full flex items-center justify-center transition-colors flex-shrink-0"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<style>
    #ai-chat-modal.hidden {
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        pointer-events: none;
    }
    #ai-chat-modal:not(.hidden) {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
</style>
