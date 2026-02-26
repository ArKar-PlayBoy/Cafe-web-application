@section('title', 'Sign In')
@extends('layouts.guest')

@section('content')
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-green-600 focus:ring-green-500" name="remember">
            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
        </label>
    </div>

    <div class="flex items-center justify-between mt-6">
        @if (Route::has('password.request'))
            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400" href="{{ route('password.request') }}">
                Forgot your password?
            </a>
        @endif

        <x-primary-button class="ml-3 bg-green-600 hover:bg-green-700">
            Sign In
        </x-primary-button>
    </div>
</form>
@endsection
