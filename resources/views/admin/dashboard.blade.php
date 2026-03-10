@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
{{-- Welcome Section with Time-based Greeting --}}
<div class="mb-8">
    @php
        $hour = now()->hour;
        $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
        $greetingIcon = $hour < 12 ? 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z' : ($hour < 17 ? 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z' : 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z');
    @endphp
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $greetingIcon }}"/>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">{{ $greeting }}, {{ Auth::guard('admin')->user()->name }}!</h1>
            </div>
            <p class="text-slate-500 dark:text-slate-400 ml-15">{{ now()->format('l, F j, Y') }} • Here's what's happening with your cafe today.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reports.sales') }}" class="px-4 py-2.5 rounded-xl bg-indigo-50 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 text-sm font-semibold border border-indigo-100 dark:border-indigo-500/30 hover:bg-indigo-100 dark:hover:bg-indigo-500/30 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Reports
            </a>
        </div>
    </div>
</div>

{{-- Stats Cards Row --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    {{-- Total Orders --}}
    <div class="glass-card relative p-5 rounded-3xl overflow-hidden group hover:scale-[1.02] transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/80 to-transparent dark:from-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10 flex items-center justify-between mb-3">
            <div class="w-11 h-11 rounded-2xl bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <span class="px-2 py-1 rounded-lg bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-bold flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                12%
            </span>
        </div>
        <div class="relative z-10">
            <p class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-slate-100 leading-none mb-1">{{ number_format($stats['totalOrders']) }}</p>
            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Total Orders</p>
        </div>
    </div>

    {{-- Revenue --}}
    <div class="glass-card relative p-5 rounded-3xl overflow-hidden group hover:scale-[1.02] transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/80 to-transparent dark:from-emerald-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10 flex items-center justify-between mb-3">
            <div class="w-11 h-11 rounded-2xl bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="px-2 py-1 rounded-lg bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-bold flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                8%
            </span>
        </div>
        <div class="relative z-10">
            <p class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-slate-100 leading-none mb-1">${{ number_format($stats['totalRevenue'], 2) }}</p>
            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Total Revenue</p>
        </div>
    </div>

    {{-- Total Users --}}
    <div class="glass-card relative p-5 rounded-3xl overflow-hidden group hover:scale-[1.02] transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-violet-50/80 to-transparent dark:from-violet-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10 flex items-center justify-between mb-3">
            <div class="w-11 h-11 rounded-2xl bg-violet-100 dark:bg-violet-500/20 flex items-center justify-center text-violet-600 dark:text-violet-400 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="px-2 py-1 rounded-lg bg-indigo-100 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 text-xs font-bold flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                Live
            </span>
        </div>
        <div class="relative z-10">
            <p class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-slate-100 leading-none mb-1">{{ number_format($stats['totalUsers']) }}</p>
            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Total Users</p>
        </div>
    </div>

    {{-- Menu Items / Stock --}}
    <div class="glass-card relative p-5 rounded-3xl overflow-hidden group hover:scale-[1.02] transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-rose-50/80 to-transparent dark:from-rose-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10 flex items-center justify-between mb-3">
            <div class="w-11 h-11 rounded-2xl bg-rose-100 dark:bg-rose-500/20 flex items-center justify-center text-rose-600 dark:text-rose-400 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <span class="px-2 py-1 rounded-lg bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 text-xs font-bold flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                {{ $stats['lowStockItems'] ?? 0 }}
            </span>
        </div>
        <div class="relative z-10">
            <p class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-slate-100 leading-none mb-1">{{ number_format($stats['totalMenuItems']) }}</p>
            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">Menu Items</p>
        </div>
    </div>
</div>

{{-- Two Column Section: Today's Focus & Quick Alerts --}}
<div class="grid lg:grid-cols-2 gap-6 mb-8">
    {{-- Today's Focus --}}
    <div class="glass-card rounded-3xl p-6 border dark:border-slate-700/50">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Today's Focus</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Requires your attention</p>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            {{-- Pending Orders --}}
            <a href="{{ route('admin.orders') }}?status=pending" class="group relative p-4 rounded-2xl bg-amber-50/50 dark:bg-amber-500/10 border border-amber-100/50 dark:border-amber-500/20 hover:bg-amber-100/50 dark:hover:bg-amber-500/20 transition-all">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-500/30 flex items-center justify-center text-amber-600 dark:text-amber-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="text-2xl font-black text-amber-600 dark:text-amber-400">{{ $stats['pendingOrders'] }}</span>
                </div>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-amber-700 dark:group-hover:text-amber-300 transition-colors">Pending Orders</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Awaiting confirmation</p>
            </a>

            {{-- Reservations --}}
            <a href="#" class="group relative p-4 rounded-2xl bg-cyan-50/50 dark:bg-cyan-500/10 border border-cyan-100/50 dark:border-cyan-500/20 hover:bg-cyan-100/50 dark:hover:bg-cyan-500/20 transition-all">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-8 h-8 rounded-lg bg-cyan-100 dark:bg-cyan-500/30 flex items-center justify-center text-cyan-600 dark:text-cyan-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-2xl font-black text-cyan-600 dark:text-cyan-400">{{ $stats['pendingReservations'] }}</span>
                </div>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-300 transition-colors">Reservations</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Need confirmation</p>
            </a>
        </div>
    </div>

    {{-- Quick Alerts --}}
    <div class="glass-card rounded-3xl p-6 border dark:border-slate-700/50">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center shadow-lg shadow-rose-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Quick Alerts</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Action needed</p>
            </div>
        </div>

        <div class="space-y-3">
            @if(($stats['lowStockItems'] ?? 0) > 0)
            <div class="flex items-center gap-3 p-3 rounded-xl bg-rose-50/50 dark:bg-rose-500/10 border border-rose-100/50 dark:border-rose-500/20">
                <div class="w-8 h-8 rounded-lg bg-rose-100 dark:bg-rose-500/30 flex items-center justify-center text-rose-600 dark:text-rose-400 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 truncate">Low Stock Alert</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $stats['lowStockItems'] }} items running low</p>
                </div>
                <a href="{{ route('admin.stock.index') }}" class="text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline">View</a>
            </div>
            @endif

            @if(Auth::guard('admin')->user()->isSuperAdmin())
            @php
                $pendingApprovals = \App\Models\ApprovalRequest::where('status', 'pending')->where(function($q) { $q->whereNull('expires_at')->orWhere('expires_at', '>', now()); })->count();
            @endphp
            @if($pendingApprovals > 0)
            <div class="flex items-center gap-3 p-3 rounded-xl bg-violet-50/50 dark:bg-violet-500/10 border border-violet-100/50 dark:border-violet-500/20">
                <div class="w-8 h-8 rounded-lg bg-violet-100 dark:bg-violet-500/30 flex items-center justify-center text-violet-600 dark:text-violet-400 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 truncate">Pending Approvals</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $pendingApprovals }} requests waiting</p>
                </div>
                <a href="{{ route('admin.approval-requests.index') }}" class="text-xs font-bold text-violet-600 dark:text-violet-400 hover:underline">View</a>
            </div>
            @endif
            @endif

            @if(($stats['todayOrders'] ?? 0) > 0)
            <div class="flex items-center gap-3 p-3 rounded-xl bg-emerald-50/50 dark:bg-emerald-500/10 border border-emerald-100/50 dark:border-emerald-500/20">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-500/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 truncate">Today's Orders</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $stats['todayOrders'] }} orders today</p>
                </div>
                <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($stats['todayRevenue'] ?? 0, 2) }}</span>
            </div>
            @endif

            @if(empty($stats['lowStockItems']) && empty($pendingApprovals))
            <div class="flex items-center gap-3 p-4 rounded-xl bg-slate-50/50 dark:bg-slate-500/10 border border-slate-100/50 dark:border-slate-500/20">
                <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-500/30 flex items-center justify-center text-slate-500 dark:text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">All caught up!</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">No urgent alerts at the moment</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Recent Orders Section --}}
<div class="glass-card rounded-3xl p-6 border dark:border-slate-700/50 mb-8">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Recent Orders</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Latest customer orders</p>
            </div>
        </div>
        <a href="{{ route('admin.orders') }}" class="px-4 py-2 rounded-xl bg-indigo-50 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 text-sm font-semibold border border-indigo-100 dark:border-indigo-500/30 hover:bg-indigo-100 dark:hover:bg-indigo-500/30 transition-all flex items-center gap-2">
            View All
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-100/50 dark:border-slate-700/50 bg-white/30 dark:bg-slate-800/30">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/80 dark:bg-slate-800/80 border-b border-slate-100 dark:border-slate-700/50">
                    <th class="px-5 py-3.5 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Order</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Customer</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Items</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Total</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Status</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Time</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100/50 dark:divide-slate-700/50">
                @forelse($recentOrders->take(5) as $order)
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-all cursor-pointer group" onclick="window.location='{{ route('admin.orders') }}'">
                    <td class="px-5 py-4">
                        <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 group-hover:underline">#{{ $order->id }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-600 dark:to-slate-700 flex items-center justify-center text-xs font-bold text-slate-600 dark:text-slate-300">
                                {{ substr($order->user->name ?? 'U', 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $order->user->name ?? 'Unknown' }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-sm text-slate-600 dark:text-slate-400">{{ $order->items_count ?? $order->items->count() }} items</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-sm font-bold text-slate-800 dark:text-slate-200">${{ number_format($order->total, 2) }}</span>
                    </td>
                    <td class="px-5 py-4">
                        @php
                            $statusConfig = [
                                'pending' => ['bg' => 'bg-amber-100 dark:bg-amber-500/20', 'text' => 'text-amber-700 dark:text-amber-400', 'dot' => 'bg-amber-500'],
                                'confirmed' => ['bg' => 'bg-blue-100 dark:bg-blue-500/20', 'text' => 'text-blue-700 dark:text-blue-400', 'dot' => 'bg-blue-500'],
                                'preparing' => ['bg' => 'bg-violet-100 dark:bg-violet-500/20', 'text' => 'text-violet-700 dark:text-violet-400', 'dot' => 'bg-violet-500'],
                                'ready' => ['bg' => 'bg-cyan-100 dark:bg-cyan-500/20', 'text' => 'text-cyan-700 dark:text-cyan-400', 'dot' => 'bg-cyan-500'],
                                'completed' => ['bg' => 'bg-emerald-100 dark:bg-emerald-500/20', 'text' => 'text-emerald-700 dark:text-emerald-400', 'dot' => 'bg-emerald-500'],
                                'cancelled' => ['bg' => 'bg-rose-100 dark:bg-rose-500/20', 'text' => 'text-rose-700 dark:text-rose-400', 'dot' => 'bg-rose-500'],
                            ];
                            $config = $statusConfig[$order->status] ?? ['bg' => 'bg-slate-100 dark:bg-slate-500/20', 'text' => 'text-slate-700 dark:text-slate-400', 'dot' => 'bg-slate-500'];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[11px] font-bold rounded-lg {{ $config['bg'] }} {{ $config['text'] }} capitalize">
                            <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }}"></span>
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-xs text-slate-500 dark:text-slate-400">{{ $order->created_at->format('h:i A') }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                            <svg class="w-12 h-12 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            <p class="text-sm font-medium">No recent orders</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Quick Actions --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
    <a href="{{ route('admin.menu.create') }}" class="group glass-card p-4 rounded-2xl border border-transparent hover:border-emerald-300 dark:hover:border-emerald-500/50 transition-all flex flex-col items-center gap-3 text-center hover:scale-[1.02]">
        <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        </div>
        <div>
            <p class="text-sm font-bold text-slate-700 dark:text-slate-300">Add Menu Item</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">Create new dish</p>
        </div>
    </a>

    <a href="{{ route('admin.users.create') }}" class="group glass-card p-4 rounded-2xl border border-transparent hover:border-blue-300 dark:hover:border-blue-500/50 transition-all flex flex-col items-center gap-3 text-center hover:scale-[1.02]">
        <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        </div>
        <div>
            <p class="text-sm font-bold text-slate-700 dark:text-slate-300">Add User</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">New staff/account</p>
        </div>
    </a>

    <a href="{{ route('admin.tables.create') }}" class="group glass-card p-4 rounded-2xl border border-transparent hover:border-violet-300 dark:hover:border-violet-500/50 transition-all flex flex-col items-center gap-3 text-center hover:scale-[1.02]">
        <div class="w-12 h-12 rounded-2xl bg-violet-100 dark:bg-violet-500/20 flex items-center justify-center text-violet-600 dark:text-violet-400 group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z"/></svg>
        </div>
        <div>
            <p class="text-sm font-bold text-slate-700 dark:text-slate-300">Add Table</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">New table setup</p>
        </div>
    </a>

    <a href="{{ route('admin.categories.create') }}" class="group glass-card p-4 rounded-2xl border border-transparent hover:border-amber-300 dark:hover:border-amber-500/50 transition-all flex flex-col items-center gap-3 text-center hover:scale-[1.02]">
        <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-500/20 flex items-center justify-center text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        </div>
        <div>
            <p class="text-sm font-bold text-slate-700 dark:text-slate-300">Add Category</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">New category</p>
        </div>
    </a>
</div>
@endsection
