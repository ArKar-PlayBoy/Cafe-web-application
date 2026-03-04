<div id="navbar-weather" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-full text-sm">
    <span id="navbar-weather-icon" class="text-lg">☀️</span>
    <span id="navbar-weather-temp" class="font-medium text-gray-700 dark:text-gray-200">--°C</span>
    <span id="navbar-weather-condition" class="hidden sm:inline text-gray-500 dark:text-gray-400 text-xs">--</span>
</div>

<script>
(function() {
    const iconEl = document.getElementById('navbar-weather-icon');
    const tempEl = document.getElementById('navbar-weather-temp');
    const conditionEl = document.getElementById('navbar-weather-condition');
    const icons = { 0: '☀️', 1: '🌤️', 2: '⛅', 3: '☁️', 45: '🌫️', 48: '🌫️', 51: '🌧️', 53: '🌧️', 55: '🌧️', 61: '🌧️', 63: '🌧️', 65: '🌧️', 80: '🌦️', 81: '🌦️', 82: '🌦️', 95: '⛈️', 96: '⛈️', 99: '⛈️' };
    
    fetch('/api/weather').then(r => r.json()).then(function(d) {
        if (tempEl) tempEl.textContent = (d.temperature != null ? Math.round(d.temperature) : '--') + '°C';
        if (conditionEl) conditionEl.textContent = d.condition || '--';
        if (iconEl) iconEl.textContent = icons[d.code] || '🌤️';
    }).catch(function() {
        if (tempEl) tempEl.textContent = '--°C';
        if (conditionEl) conditionEl.textContent = 'Unavailable';
    });
})();
</script>
