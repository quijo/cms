<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 text-center">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Welcome to MyDashboard</h1>
        <p class="text-gray-600 mb-6">Manage your users, stats, and more with ease.</p>

        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="inline-block px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

</body>
</html>