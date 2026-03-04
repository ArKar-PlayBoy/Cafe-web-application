@extends('layouts.staff')

@section('title', 'Dashboard')

@section('content')
<<<<<<< HEAD
<h1 class="text-2xl font-bold mb-6 dark:text-white">Staff Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Pending Orders</h3>
        <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['pendingOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Preparing</h3>
        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['preparingOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Ready</h3>
        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $stats['readyOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Pending Reservations</h3>
        <p class="text-3xl font-bold dark:text-white">{{ $stats['pendingReservations'] }}</p>
    </div>
</div>
=======
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Staff Dashboard</h1>
    <p class="text-slate-500 dark:text-slate-400 mt-1">Hello, {{ Auth::guard('staff')->user()->name }}. Let's serve some great food today!</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Pending Orders -->
    <div class="glass-card p-6 rounded-3xl hover:shadow-xl transition-all duration-300 relative overflow-hidden group border-l-4 border-amber-500">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-500/20 flex items-center justify-center text-amber-600 dark:text-amber-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-widest">Urgent</span>
        </div>
        <h3 class="text-slate-500 dark:text-slate-400 text-sm font-semibold uppercase tracking-wider">Pending Orders</h3>
        <p class="text-4xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $stats['pendingOrders'] }}</p>
    </div>

    <!-- Preparing -->
    <div class="glass-card p-6 rounded-3xl hover:shadow-xl transition-all duration-300 relative overflow-hidden group border-l-4 border-blue-500">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest">In Progress</span>
        </div>
        <h3 class="text-slate-500 dark:text-slate-400 text-sm font-semibold uppercase tracking-wider">Preparing</h3>
        <p class="text-4xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $stats['preparingOrders'] }}</p>
    </div>

    <!-- Ready -->
    <div class="glass-card p-6 rounded-3xl hover:shadow-xl transition-all duration-300 relative overflow-hidden group border-l-4 border-emerald-500">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">Cooked</span>
        </div>
        <h3 class="text-slate-500 dark:text-slate-400 text-sm font-semibold uppercase tracking-wider">Ready</h3>
        <p class="text-4xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $stats['readyOrders'] }}</p>
    </div>

    <!-- Reservations -->
    <div class="glass-card p-6 rounded-3xl hover:shadow-xl transition-all duration-300 relative overflow-hidden group border-l-4 border-violet-500">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl bg-violet-100 dark:bg-violet-500/20 flex items-center justify-center text-violet-600 dark:text-violet-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <span class="text-xs font-bold text-violet-600 dark:text-violet-400 uppercase tracking-widest">Upcoming</span>
        </div>
        <h3 class="text-slate-500 dark:text-slate-400 text-sm font-semibold uppercase tracking-wider">Pending Reservations</h3>
        <p class="text-4xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $stats['pendingReservations'] }}</p>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
    <a href="{{ route('staff.orders') }}" class="glass-card p-8 rounded-3xl flex items-center justify-between group hover:bg-amber-500 transition-all duration-500">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 rounded-2xl bg-amber-500 text-white flex items-center justify-center shadow-lg group-hover:bg-white group-hover:text-amber-500 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white group-hover:text-white transition-colors">Manage Orders</h2>
                <p class="text-slate-500 dark:text-slate-400 group-hover:text-amber-100 transition-colors">View and update current orders</p>
            </div>
        </div>
        <svg class="w-8 h-8 text-slate-300 group-hover:text-white group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>

    <a href="{{ route('staff.reservations') }}" class="glass-card p-8 rounded-3xl flex items-center justify-between group hover:bg-teal-500 transition-all duration-500">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 rounded-2xl bg-teal-500 text-white flex items-center justify-center shadow-lg group-hover:bg-white group-hover:text-teal-500 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white group-hover:text-white transition-colors">Reservations</h2>
                <p class="text-slate-500 dark:text-slate-400 group-hover:text-teal-100 transition-colors">Check table bookings</p>
            </div>
        </div>
        <svg class="w-8 h-8 text-slate-300 group-hover:text-white group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>
</div>
>>>>>>> 5b466fb (more reliable and front-end changes)
@endsection
