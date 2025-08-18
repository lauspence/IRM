@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <!-- Card with visible background color -->
    <div class="w-full max-w-2xl bg-blue-50 rounded-lg shadow-xl p-8 border border-blue-200">
        <h1 class="text-2xl font-bold text-center text-blue-800 mb-8">Create New User</h1>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
    
            <!-- Name -->
            <div class="flex items-center gap-6 mb-6">
                <label for="name" class="w-1/4 text-sm font-semibold text-gray-900">Name</label>
                <input type="text" id="name" name="name" required
                       class="flex-1 px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm 
                              focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
            </div>
            <!-- <div class="text-red-500 font-bold">Hello Tailwind!</div> -->

            <div class="flex items-center gap-6 mb-6">
                <label for="email" class="w-1/4 text-sm font-semibold text-gray-900">Email</label>
                <input type="email" id="email" name="email" required
                    class="flex-1 px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm 
                            focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password -->
            <div class="flex items-center gap-6 mb-6">
                <label for="password" class="w-1/4 text-sm font-semibold text-gray-900">Password</label>
                <input type="password" id="password" name="password" required
                       class="flex-1 px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm 
                              focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Confirm Password -->
            <div class="flex items-center gap-6 mb-6">
                <label for="password_confirmation" class="w-1/4 text-sm font-semibold text-gray-900">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="flex-1 px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm 
                              focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Role -->
            <div class="flex items-center gap-6 mb-6">
                <label for="role" class="w-1/4 text-sm font-semibold text-gray-900">Role</label>
                <select id="role" name="role" required
                        class="flex-1 px-3 py-2 text-sm text-gray-900 border border-gray-300 bg-white rounded-md shadow-sm 
                               focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="staff">Staff</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="pt-6">
                <button type="submit"
                        class="w-full py-3 rounded-md shadow-md text-base font-semibold text-blue 
                            bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    Create User
                </button>
            </div>

        </form>
    </div>
    
</div>
@endsection
