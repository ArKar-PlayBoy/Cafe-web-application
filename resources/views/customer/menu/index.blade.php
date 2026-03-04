@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6">
    <!-- Header with Title and Sort -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold text-gray-800 dark:text-white">Our Menu</h1>
            <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400 hidden sm:block">Discover our selection of coffee, tea, and delicious treats</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
            <!-- Search Input -->
            <div class="relative w-full sm:w-auto">
                <input type="text" id="menu-search" placeholder="Search..." 
                    class="w-full sm:w-48 md:w-64 px-3 py-2 pl-9 sm:pl-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 text-sm">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <!-- Sort Dropdown -->
            <select id="sort-select" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 text-sm">
                <option value="default">Sort by</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
                <option value="name-asc">Name: A to Z</option>
                <option value="name-desc">Name: Z to A</option>
            </select>
        </div>
    </div>

    <!-- Mobile Filter Toggle -->
    <div class="lg:hidden mb-4">
        <button onclick="document.getElementById('mobile-filters').classList.toggle('hidden')" class="w-full flex items-center justify-between px-4 py-3 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
            <span class="font-medium text-gray-700 dark:text-gray-300">Filters</span>
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
        </button>
    </div>

    <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
        <!-- Sidebar Categories (Desktop) / Mobile Filters -->
        <aside class="lg:w-64 shrink-0">
            <!-- Mobile Filters Panel -->
            <div id="mobile-filters" class="lg:hidden hidden bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl border border-white/20 dark:border-gray-700/50 rounded-3xl p-4 sm:p-6 mb-4">
                <h3 class="font-heading font-bold text-gray-800 dark:text-white mb-4 text-lg">Categories</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('menu') }}" class="flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300 {{ !request('category') ? 'bg-gradient-to-r from-teal-500 to-emerald-500 text-white shadow-md shadow-teal-500/20 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-700 hover:shadow-sm' }}">
                            <span>All Items</span>
                            <span class="text-xs py-1 px-2 rounded-full {{ !request('category') ? 'bg-white/20 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400' }}">{{ $menuItems->count() }}</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('menu', ['category' => $category->id]) }}" class="flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300 {{ request('category') == $category->id ? 'bg-gradient-to-r from-teal-500 to-emerald-500 text-white shadow-md shadow-teal-500/20 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-700 hover:shadow-sm' }}">
                            <span>{{ $category->name }}</span>
                            <span class="text-xs py-1 px-2 rounded-full {{ request('category') == $category->id ? 'bg-white/20 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400' }}">{{ $category->menuItems->count() }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>

                <!-- Price Filter -->
                <h3 class="font-heading font-bold text-gray-800 dark:text-white mt-6 sm:mt-8 mb-4 text-lg">Price Range</h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 text-gray-600 dark:text-gray-300 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" class="price-filter peer sr-only" value="0-4">
                            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded flex items-center justify-center peer-checked:bg-teal-500 peer-checked:border-teal-500 transition-colors">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <span class="text-sm font-medium group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">Under $4</span>
                    </label>
                    <label class="flex items-center gap-3 text-gray-600 dark:text-gray-300 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" class="price-filter peer sr-only" value="4-6">
                            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded flex items-center justify-center peer-checked:bg-teal-500 peer-checked:border-teal-500 transition-colors">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <span class="text-sm font-medium group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">$4 - $6</span>
                    </label>
                    <label class="flex items-center gap-3 text-gray-600 dark:text-gray-300 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" class="price-filter peer sr-only" value="6-10">
                            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded flex items-center justify-center peer-checked:bg-teal-500 peer-checked:border-teal-500 transition-colors">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <span class="text-sm font-medium group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">$6 - $10</span>
                    </label>
                </div>
            </div>

            <!-- Desktop Sidebar -->
            <div class="hidden lg:block bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl border border-white/20 dark:border-gray-700/50 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.1)] p-6 sticky top-24">
                <h3 class="font-heading font-bold text-gray-800 dark:text-white mb-4 text-lg">Categories</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('menu') }}" class="flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300 {{ !request('category') ? 'bg-gradient-to-r from-teal-500 to-emerald-500 text-white shadow-md shadow-teal-500/20 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-700 hover:shadow-sm' }}">
                            <span>All Items</span>
                            <span class="text-xs py-1 px-2 rounded-full {{ !request('category') ? 'bg-white/20 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400' }}">{{ $menuItems->count() }}</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('menu', ['category' => $category->id]) }}" class="flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-300 {{ request('category') == $category->id ? 'bg-gradient-to-r from-teal-500 to-emerald-500 text-white shadow-md shadow-teal-500/20 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-700 hover:shadow-sm' }}">
                            <span>{{ $category->name }}</span>
                            <span class="text-xs py-1 px-2 rounded-full {{ request('category') == $category->id ? 'bg-white/20 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400' }}">{{ $category->menuItems->count() }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>

                <!-- Price Filter -->
                <h3 class="font-heading font-bold text-gray-800 dark:text-white mt-8 mb-4 text-lg">Price Range</h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 text-gray-600 dark:text-gray-300 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" class="price-filter peer sr-only" value="0-4">
                            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded flex items-center justify-center peer-checked:bg-teal-500 peer-checked:border-teal-500 transition-colors">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <span class="text-sm font-medium group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">Under $4</span>
                    </label>
                    <label class="flex items-center gap-3 text-gray-600 dark:text-gray-300 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" class="price-filter peer sr-only" value="4-6">
                            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded flex items-center justify-center peer-checked:bg-teal-500 peer-checked:border-teal-500 transition-colors">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <span class="text-sm font-medium group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">$4 - $6</span>
                    </label>
                    <label class="flex items-center gap-3 text-gray-600 dark:text-gray-300 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" class="price-filter peer sr-only" value="6-10">
                            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded flex items-center justify-center peer-checked:bg-teal-500 peer-checked:border-teal-500 transition-colors">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <span class="text-sm font-medium group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">$6 - $10</span>
                    </label>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <!-- Category Pills (Mobile) -->
            <div class="flex gap-2 mb-4 overflow-x-auto pb-2 lg:hidden sticky top-[64px] z-30 bg-slate-50/90 dark:bg-slate-900/90 backdrop-blur-md pt-4 -mx-3 px-3 sm:-mx-4 sm:px-4">
                <a href="{{ route('menu') }}" class="px-4 py-2 rounded-full whitespace-nowrap {{ !request('category') ? 'bg-teal-600 text-white' : 'bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                    All
                </a>
                @foreach($categories as $category)
                <a href="{{ route('menu', ['category' => $category->id]) }}" class="px-4 py-2 rounded-full whitespace-nowrap {{ request('category') == $category->id ? 'bg-teal-600 text-white' : 'bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>

            <!-- AI Barista Banner -->
            <div class="mb-4 flex items-center justify-between">
                <div class="hidden md:flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 bg-gradient-to-r from-purple-50 to-teal-50 dark:from-purple-900/20 dark:to-teal-900/20 px-4 py-2 rounded-full">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                    </span>
                    <span>AI Barista Available!</span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400"><span id="item-count">{{ $menuItems->count() }}</span> items</p>
            </div>

            <!-- Product Grid -->
            <div id="menu-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-3 sm:gap-4">
                @forelse($menuItems as $item)
                <div class="menu-item bg-white/60 dark:bg-gray-800/60 backdrop-blur-lg border border-white/20 dark:border-gray-700/50 rounded-3xl shadow-sm hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] dark:hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.3)] overflow-hidden transition-all duration-500 group relative hover:-translate-y-2" 
                     data-name="{{ strtolower($item->name) }}" 
                     data-price="{{ $item->price }}"
                     data-category="{{ $item->category->slug }}">
                    <div class="relative h-48 overflow-hidden rounded-t-3xl mask mask-squircle m-2">
                        <img src="{{ $item->featured_image }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Floating Price Tag -->
                        <div class="absolute top-3 right-3 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md px-3 py-1.5 rounded-full shadow-lg border border-white/20 z-10">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">${{ number_format($item->price, 2) }}</span>
                        </div>

                        @if(!$item->is_available)
                        <div class="absolute top-3 left-3 bg-red-500/90 backdrop-blur-md text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">Sold Out</div>
                        @endif
                    </div>
                    <div class="p-5 pt-4">
                        <div class="mb-2">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase tracking-wider">{{ $item->category->name }}</span>
                        </div>
                        <h3 class="font-heading font-bold text-xl text-gray-800 dark:text-white mb-2">{{ $item->name }}</h3>
                        
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1 mb-3">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= 4 ? 'text-amber-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                            <span class="text-xs text-gray-400 ml-1">({{ rand(50, 200) }})</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">{{ $item->description }}</p>
                        
                        @if($item->is_available)
                        <!-- Add to Cart (Revealed on hover on desktop, always visible on mobile) -->
                        <div class="mt-auto transition-all duration-300 transform sm:translate-y-2 sm:opacity-0 group-hover:translate-y-0 group-hover:opacity-100">
                            <form action="{{ route('cart.add', $item->id) }}" method="POST" class="flex gap-2 items-center quick-add-form relative z-20">
                                @csrf
                                <div class="relative flex border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden bg-white dark:bg-gray-800">
                                    <button type="button" class="px-3 py-2 text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" onclick="this.nextElementSibling.stepDown()">-</button>
                                    <input type="number" name="quantity" value="1" min="1" max="99" class="w-12 text-center bg-transparent border-none focus:ring-0 text-sm font-medium p-0">
                                    <button type="button" class="px-3 py-2 text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" onclick="this.previousElementSibling.stepUp()">+</button>
                                </div>
                                <button type="submit" class="flex-1 bg-gray-900 hover:bg-teal-600 dark:bg-white dark:text-gray-900 text-white dark:hover:bg-teal-500 dark:hover:text-white py-2.5 px-4 rounded-xl text-sm font-medium shadow-md transition-all duration-300 flex justify-center items-center gap-2">
                                    <span>Add</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="mt-auto">
                            <button disabled class="w-full bg-gray-100 dark:bg-gray-700 text-gray-400 py-2.5 rounded-xl text-sm font-medium cursor-not-allowed">
                                Out of Stock
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">No items found</p>
                    <a href="{{ route('menu') }}" class="text-teal-600 hover:underline mt-2 inline-block">Clear filters</a>
                </div>
                @endforelse
            </div>
        </main>
    </div>
</div>

<!-- Floating Cart Summary -->
<div id="floating-cart" class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-4 rounded-full shadow-2xl z-50 transition-all duration-300 transform translate-y-full opacity-0 flex items-center gap-4 border border-white/10 dark:border-slate-900/10">
    <div class="flex items-center gap-2">
        <div class="relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <span id="floating-cart-count" class="absolute -top-2 -right-2 bg-teal-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
        </div>
        <span class="font-medium hidden sm:inline">Items in cart</span>
    </div>
    <div class="w-px h-6 bg-white/20 dark:bg-slate-900/20"></div>
    <a href="{{ route('cart') }}" class="font-bold hover:text-teal-400 dark:hover:text-teal-600 transition-colors flex items-center gap-1">
        View Cart
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('menu-search');
    const sortSelect = document.getElementById('sort-select');
    const menuItems = document.querySelectorAll('.menu-item');
    const priceFilters = document.querySelectorAll('.price-filter');
    const itemCountEl = document.getElementById('item-count');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    function filterItems() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedPrices = Array.from(priceFilters).filter(cb => cb.checked).map(cb => cb.value);
        const sortValue = sortSelect.value;

        let filteredItems = Array.from(menuItems);

        // Filter by search
        if (searchTerm) {
            filteredItems = filteredItems.filter(item => {
                const name = item.dataset.name;
                return name.includes(searchTerm);
            });
        }

        // Filter by price
        if (selectedPrices.length > 0) {
            filteredItems = filteredItems.filter(item => {
                const price = parseFloat(item.dataset.price);
                return selectedPrices.some(range => {
                    const [min, max] = range.split('-').map(Number);
                    return price >= min && price < max;
                });
            });
        }

        // Sort
        filteredItems.sort((a, b) => {
            const priceA = parseFloat(a.dataset.price);
            const priceB = parseFloat(b.dataset.price);
            const nameA = a.dataset.name;
            const nameB = b.dataset.name;

            switch(sortValue) {
                case 'price-low': return priceA - priceB;
                case 'price-high': return priceB - priceA;
                case 'name-asc': return nameA.localeCompare(nameB);
                case 'name-desc': return nameB.localeCompare(nameA);
                default: return 0;
            }
        });

        // Show/hide items
        menuItems.forEach(item => item.style.display = 'none');
        filteredItems.forEach(item => item.style.display = '');
        
        // Update count
        itemCountEl.textContent = filteredItems.length;
    }

    searchInput.addEventListener('input', filterItems);
    sortSelect.addEventListener('change', filterItems);
    priceFilters.forEach(cb => cb.addEventListener('change', filterItems));

    // Quick add to cart feedback
    document.querySelectorAll('.quick-add-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button[type="submit"]');
            const originalHTML = btn.innerHTML;
            
            btn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>';
            
            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            }).then(response => {
                if(response.redirected) {
                    window.location.href = response.url;
                    return null;
                }
                return response.json().then(data => ({ status: response.status, body: data }));
            })
            .then(result => {
                if(!result) return; // handled by redirect
                const { status, body } = result;
                if (status >= 200 && status < 300 && body.success) {
                    btn.innerHTML = '<svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    
                    // Update badges
                    const counts = document.querySelectorAll('.cart-count-badge');
                    counts.forEach(c => {
                        c.textContent = body.cartCount > 9 ? '9+' : body.cartCount;
                        c.classList.remove('hidden');
                        c.classList.add('flex');
                    });
                    
                    const floatingCart = document.getElementById('floating-cart');
                    const floatingCount = document.getElementById('floating-cart-count');
                    if (floatingCart && floatingCount) {
                        floatingCount.textContent = body.cartCount;
                        floatingCart.classList.remove('translate-y-full', 'opacity-0');
                    }
                    
                    setTimeout(() => {
                        btn.innerHTML = originalHTML;
                    }, 2000);
                } else {
                    btn.innerHTML = originalHTML;
                    alert(body.message || 'Failed to add item to cart');
                }
            }).catch(() => {
                btn.innerHTML = originalHTML;
                alert('Failed to add item to cart. Please check your connection.');
            });
        });
    });
});
</script>
@endsection
