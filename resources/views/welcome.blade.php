<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to IMS</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to the Inventory Management System</h1>
        <p class="text-gray-600 mb-6">Please sign in to manage your inventory or register to create an account.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 transition duration-300">Register</a>
            @endif
        </div>
    </div>
</body>
</html>