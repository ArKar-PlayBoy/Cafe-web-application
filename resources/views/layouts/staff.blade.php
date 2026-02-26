<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff Dashboard') - Cafe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body x-data="{
    theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        const html = document.documentElement;
        if (this.theme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        localStorage.setItem('theme', this.theme);
    }
}" class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white transition-colors duration-300">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">C</span>
                    </div>
                    <span class="font-semibold text-xl text-green-700 dark:text-green-400">Staff</span>
                </a>
                <button @click="toggleTheme" class="p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg x-show="theme === 'dark'" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                    </svg>
                    <svg x-show="theme === 'light'" class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                    </svg>
                </button>
            </div>
            <nav class="mt-4">
                <a href="{{ route('staff.dashboard') }}" class="block py-2.5 px-4 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('staff.dashboard') ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('staff.orders') }}" class="block py-2.5 px-4 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('staff.orders*') ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : '' }}">
                    Orders
                </a>
                <a href="{{ route('staff.reservations') }}" class="block py-2.5 px-4 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('staff.reservations*') ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : '' }}">
                    Reservations
                </a>
            </nav>
            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-200 dark:border-gray-700">
                <form method="POST" action="{{ route('staff.logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
                </form>
            </div>
        </aside>
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
