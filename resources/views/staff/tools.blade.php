@extends('layouts.app')

@section('title', 'Staff Tools')

@section('content')
<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full bg-white shadow z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold text-blue-600">Staff Portal</a>
            </div>

            <!-- Links -->
            <div class="flex space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-600 transition font-medium">Dashboard</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition font-medium">Tasks</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition font-medium">Messages</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition font-medium">Profile</a>
            </div>

            <!-- Right Side (Logout) -->
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-gray-100 pt-24 pb-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Staff Tools</h1>
            <p class="mt-2 text-lg text-gray-600">Your essential tools for productivity and collaboration</p>
        </div>

        <!-- Tools Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Dashboard -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex flex-col">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6h6v6m-6 4h6m4-14h-4m-6 0H5m4 7v6m0-6V5m6 6v6m0-6V5"/>
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-800">Dashboard</h2>
                </div>
                <p class="text-gray-600 mb-6 text-sm flex-grow">Monitor key metrics and team analytics.</p>
                <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium text-center hover:bg-blue-700 transition">
                    Go to Dashboard
                </a>
            </div>

            <!-- Task Manager -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex flex-col">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-800">Task Manager</h2>
                </div>
                <p class="text-gray-600 mb-6 text-sm flex-grow">Organize and track your tasks efficiently.</p>
                <a href="#" class="inline-block bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium text-center hover:bg-green-700 transition">
                    Manage Tasks
                </a>
            </div>

            <!-- Messages -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex flex-col">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-800">Messages</h2>
                </div>
                <p class="text-gray-600 mb-6 text-sm flex-grow">Stay connected with team updates.</p>
                <a href="#" class="inline-block bg-purple-600 text-white px-4 py-2 rounded-md text-sm font-medium text-center hover:bg-purple-700 transition">
                    View Messages
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
