@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Admin Dashboard</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1">Welcome back, {{ Auth::guard('admin')->user()->name }}. Here's what's happening today.</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="px-4 py-2 rounded-xl glass-card text-slate-700 dark:text-slate-200 font-medium hover:bg-white dark:hover:bg-slate-800 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export Report
        </button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Orders -->
    <div class="glass-card p-6 rounded-3xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-500/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-semibold uppercase tracking-wider">Total Orders</h3>
        </div>
        <p class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ number_format($stats['totalOrders']) }}</p>
        <div class="mt-4 flex items-center text-xs font-medium text-emerald-500">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <span>+12.5% from last month</span>
        </div>
    </div>

    <!-- Revenue -->
    <div class="glass-card p-6 rounded-3xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-semibold uppercase tracking-wider">Revenue</h3>
        </div>
        <p class="text-4xl font-extrabold text-slate-900 dark:text-white">${{ number_format($stats['totalRevenue'], 2) }}</p>
        <div class="mt-4 flex items-center text-xs font-medium text-emerald-500">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <span>+8.2% from last week</span>
        </div>
    </div>

    <!-- Users -->
    <div class="glass-card p-6 rounded-3xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-violet-500/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-violet-100 dark:bg-violet-500/20 flex items-center justify-center text-violet-600 dark:text-violet-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-semibold uppercase tracking-wider">Total Users</h3>
        </div>
        <p class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $stats['totalUsers'] }}</p>
        <div class="mt-4 flex items-center text-xs font-medium text-slate-400">
            <span>New registrations active</span>
        </div>
    </div>

    <!-- Items -->
    <div class="glass-card p-6 rounded-3xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-rose-500/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-500/20 flex items-center justify-center text-rose-600 dark:text-rose-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-semibold uppercase tracking-wider">Menu Items</h3>
        </div>
        <p class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $stats['totalMenuItems'] }}</p>
        <div class="mt-4 flex items-center text-xs font-medium text-rose-500">
            <span>5 items out of stock</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
    <div class="lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Recent Orders</h2>
            <a href="{{ route('admin.orders') }}" class="text-indigo-600 dark:text-indigo-400 text-sm font-bold hover:underline">View All</a>
        </div>
        <div class="glass-card rounded-3xl overflow-hidden border-none shadow-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-indigo-50/50 dark:bg-slate-800/50">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">#{{ $order->id }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-800 dark:text-slate-200 font-medium">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-slate-800 dark:text-slate-200 font-bold">${{ number_format($order->total, 2) }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusStyles = [
                                    'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400',
                                    'completed' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400',
                                    'cancelled' => 'bg-rose-100 text-rose-700 dark:bg-rose-500/10 dark:text-rose-400',
                                ];
                                $currentStyle = $statusStyles[$order->status] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-500/10 dark:text-slate-400';
                            @endphp
                            <span class="px-2.5 py-1 text-xs font-bold rounded-lg {{ $currentStyle }} uppercase">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400 italic">No recent orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Quick Stats</h2>
        <div class="space-y-4">
            <div class="glass-card p-5 rounded-3xl flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-500/20 flex items-center justify-center text-amber-600 dark:text-amber-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">Pending Orders</p>
                        <p class="text-lg font-extrabold text-slate-900 dark:text-white">{{ $stats['pendingOrders'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="glass-card p-5 rounded-3xl flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">Today's Orders</p>
                        <p class="text-lg font-extrabold text-slate-900 dark:text-white">{{ $stats['todayOrders'] }}</p>
                    </div>
                </div>
            </div>

            <div class="glass-card p-5 rounded-3xl flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-cyan-100 dark:bg-cyan-500/20 flex items-center justify-center text-cyan-600 dark:text-cyan-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">Pending Reservations</p>
                        <p class="text-lg font-extrabold text-slate-900 dark:text-white">{{ $stats['pendingReservations'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
