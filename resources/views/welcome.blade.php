<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Cafe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-stone-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">
    <nav class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">C</span>
                        </div>
                        <span class="font-semibold text-xl text-green-700 dark:text-green-400">Cafe</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 hidden dark:block text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                        </svg>
                        <svg class="w-5 h-5 block dark:hidden text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-b from-green-900/20 to-transparent pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-5xl font-serif font-bold text-green-800 dark:text-green-400 mb-4">Welcome to Cafe</h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">Experience the finest coffee, delicious pastries, and a warm atmosphere. Your perfect escape awaits.</p>
                    
                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('login') }}" class="bg-green-600 text-white px-8 py-3 rounded-full hover:bg-green-700 transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="border-2 border-green-600 text-green-600 dark:text-green-400 px-8 py-3 rounded-full hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors">Join Now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Quality Coffee</h3>
                    <p class="text-gray-600 dark:text-gray-400">Premium beans sourced from around the world</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fresh Pastries</h3>
                    <p class="text-gray-600 dark:text-gray-400">Baked fresh daily with love</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Cozy Space</h3>
                    <p class="text-gray-600 dark:text-gray-400">Perfect spot to relax and unwind</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 py-16 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-serif font-bold mb-4">Ready to Order?</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-8">Browse our menu and place your order online</p>
                <a href="{{ route('menu') }}" class="inline-block bg-green-600 text-white px-8 py-3 rounded-full hover:bg-green-700 transition-colors">View Menu</a>
            </div>
        </div>

        <footer class="bg-stone-100 dark:bg-gray-900 py-8 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 dark:text-gray-400">
                <div class="flex justify-center gap-4 mb-4">
                    <a href="{{ route('admin.login') }}" class="hover:text-green-600 dark:hover:text-green-400">Admin</a>
                    <span>|</span>
                    <a href="{{ route('staff.login') }}" class="hover:text-green-600 dark:hover:text-green-400">Staff</a>
                </div>
                <p>&copy; 2026 Cafe. All rights reserved.</p>
            </div>
        </footer>
    </main>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });
        }

        // Initialize theme
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const html = document.documentElement;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            html.classList.add('dark');
        }
    </script>
</body>
</html>
