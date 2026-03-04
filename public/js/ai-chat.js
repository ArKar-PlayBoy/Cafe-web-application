(function() {
    'use strict';

    const API_BASE = '/api';
    let weatherData = null;
    let isModalOpen = false;

    const elements = {
        button: null,
        modal: null,
        closeBtn: null,
        chatForm: null,
        chatInput: null,
        messagesContainer: null,
        weatherDisplay: null,
        quickSuggestions: null
    };

    function init() {
        elements.button = document.getElementById('ai-barista-button');
        elements.modal = document.getElementById('ai-chat-modal');
        elements.closeBtn = document.getElementById('ai-chat-close');
        elements.chatForm = document.getElementById('ai-chat-form');
        elements.chatInput = document.getElementById('ai-chat-input');
        elements.messagesContainer = document.getElementById('ai-chat-messages');
        elements.weatherDisplay = document.getElementById('ai-weather-display');
        elements.quickSuggestions = document.getElementById('ai-quick-suggestions');

        if (!elements.button || !elements.modal) {
            return;
        }

        elements.button.addEventListener('click', toggleModal);
        elements.closeBtn?.addEventListener('click', closeModal);
        elements.chatForm?.addEventListener('submit', handleSubmit);
        
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('quick-suggestion')) {
                const query = e.target.dataset.query;
                elements.chatInput.value = query;
                handleSubmit(e);
            }
        });

        elements.modal.addEventListener('click', function(e) {
            if (e.target === elements.modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isModalOpen) {
                closeModal();
            }
        });
    }

    async function toggleModal() {
        if (isModalOpen) {
            closeModal();
        } else {
            openModal();
        }
    }

    async function openModal() {
        elements.modal.classList.remove('hidden');
        isModalOpen = true;
        
        await loadWeather();
        elements.chatInput.focus();
    }

    function closeModal() {
        elements.modal.classList.add('hidden');
        isModalOpen = false;
    }

    async function loadWeather() {
        try {
            const response = await fetch(`${API_BASE}/weather`);
            if (!response.ok) throw new Error('Weather API failed');
            const data = await response.json();
            weatherData = data;
            updateWeatherDisplay(data);
        } catch (error) {
            console.error('Failed to load weather:', error);
            const tempEl = document.getElementById('ai-temperature');
            const conditionEl = document.getElementById('ai-condition');
            if (tempEl) tempEl.textContent = '--°C';
            if (conditionEl) conditionEl.textContent = 'Unavailable';
        }
    }

    function updateWeatherDisplay(data) {
        const locationEl = document.getElementById('ai-location');
        const tempEl = document.getElementById('ai-temperature');
        const conditionEl = document.getElementById('ai-condition');
        const iconEl = document.getElementById('ai-weather-icon');

        if (locationEl) locationEl.textContent = data.location || 'Yangon, Myanmar';
        if (tempEl) tempEl.textContent = `${Math.round(data.temperature)}°C`;
        if (conditionEl) conditionEl.textContent = data.condition || 'Clear sky';
        if (iconEl) iconEl.textContent = getWeatherIcon(data.code);
    }

    function getWeatherIcon(code) {
        const icons = {
            0: '☀️', 1: '🌤️', 2: '⛅', 3: '☁️',
            45: '🌫️', 48: '🌫️',
            51: '🌧️', 53: '🌧️', 55: '🌧️',
            61: '🌧️', 63: '🌧️', 65: '🌧️',
            71: '❄️', 73: '❄️', 75: '❄️',
            80: '🌦️', 81: '🌦️', 82: '🌦️',
            95: '⛈️', 96: '⛈️', 99: '⛈️'
        };
        return icons[code] || '🌤️';
    }

    async function handleSubmit(e) {
        e.preventDefault();
        
        const message = elements.chatInput.value.trim();
        if (!message) return;

        addUserMessage(message);
        elements.chatInput.value = '';

        try {
            const response = await fetch(`${API_BASE}/recommend?q=${encodeURIComponent(message)}`);
            const data = await response.json();
            
            addBotMessage(data);
        } catch (error) {
            addBotMessage({
                recommendations: [],
                reason: 'Sorry, something went wrong. Please try again.'
            });
        }
    }

    function addUserMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex gap-3 flex-row-reverse';
        messageDiv.innerHTML = `
            <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div class="bg-green-600 rounded-2xl rounded-tr-sm px-4 py-2 max-w-[80%] text-white">
                <p class="text-sm">${escapeHtml(message)}</p>
            </div>
        `;
        elements.messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    function addBotMessage(data) {
        const greeting = data.weather ? getGreeting(data.weather.temperature) : 'Here are my recommendations:';
        let bodyHtml = '';

        if (data.recommendations && data.recommendations.length > 0) {
            bodyHtml = `
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">${escapeHtml(data.reason)}</p>
                <div class="grid grid-cols-1 gap-2">
                    ${data.recommendations.map(drink => `
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-100">${escapeHtml(drink.name)}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">${escapeHtml(drink.description)}</p>
                            </div>
                            <span class="text-green-600 dark:text-green-400 font-bold">$${Number(drink.price).toFixed(2)}</span>
                        </div>
                    `).join('')}
                </div>
            `;
        } else {
            bodyHtml = `<p class="text-sm text-gray-600 dark:text-gray-400">${escapeHtml(data.reason || "I'm not sure what to recommend. Try telling me how you're feeling!")}</p>`;
        }

        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex gap-3';
        messageDiv.innerHTML = `
            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl rounded-tl-sm px-4 py-2 max-w-[85%]">
                <p class="text-sm text-gray-700 dark:text-gray-300">${escapeHtml(greeting)}</p>
                <div class="mt-2">${bodyHtml}</div>
            </div>
        `;
        elements.messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    function getGreeting(temperature) {
        if (temperature > 25) {
            return "It's a hot one today! How about something cool and refreshing? ☀️";
        } else if (temperature < 15) {
            return "It's chilly outside! Let me warm you up with something cozy! 🧣";
        } else {
            return "Perfect weather for any drink! Here are my top picks:";
        }
    }

    function scrollToBottom() {
        elements.messagesContainer.scrollTop = elements.messagesContainer.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
