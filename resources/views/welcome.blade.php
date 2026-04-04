<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Church CMS</h1>
            <div>
    @auth
        <a href="{{ route('dashboard') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Dashboard
        </a>
    @endauth

    @guest
        <a href="{{ route('login') }}"
           class="mr-4 text-gray-600 hover:text-blue-600">
            Login
        </a>

        <a href="{{ route('register') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Register
        </a>
    @endguest
</div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-20 text-center">
        <h1 class="text-4xl font-bold mb-4">
    Welcome to the Central Visayas District
</h1>

<p class="text-lg mb-2">
    Church of the Nazarene
</p>

<p class="text-md text-gray-200">
    Growing in faith, serving in love, and reaching communities for Christ.
</p>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-3 gap-8">

        <!-- Announcements -->
        <div class="md:col-span-1 bg-white p-6 rounded-2xl shadow">
            <h3 class="text-xl font-semibold mb-4">Announcements</h3>

            <ul class="space-y-4">
                <li class="border-b pb-2">
                    <p class="font-medium">Sunday Service</p>
                    <p class="text-sm text-gray-500">Join us every Sunday at 9:00 AM.</p>
                </li>
                <li class="border-b pb-2">
                    <p class="font-medium">Youth Fellowship</p>
                    <p class="text-sm text-gray-500">Friday at 6:00 PM.</p>
                </li>
                <li>
                    <p class="font-medium">Prayer Meeting</p>
                    <p class="text-sm text-gray-500">Wednesday at 7:00 PM.</p>
                </li>
            </ul>
        </div>

        <!-- Articles -->
        <div class="md:col-span-2 space-y-6">

            <h3 class="text-2xl font-semibold">Latest Articles</h3>

            <!-- Article Card -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <h4 class="text-xl font-bold mb-2">The Greatness of God</h4>
                <p class="text-gray-600 mb-4">Reflecting on God's power and love in our daily lives.</p>
                <a href="#" class="text-blue-600 hover:underline">Read more</a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <h4 class="text-xl font-bold mb-2">Walking in Faith</h4>
                <p class="text-gray-600 mb-4">How to trust God even in uncertain times.</p>
                <a href="#" class="text-blue-600 hover:underline">Read more</a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <h4 class="text-xl font-bold mb-2">Serving with Love</h4>
                <p class="text-gray-600 mb-4">The importance of serving others in the church.</p>
                <a href="#" class="text-blue-600 hover:underline">Read more</a>
            </div>

        </div>
    </div>

    {{-- <!-- Login Section -->
    <div class="bg-gray-200 py-16">
        <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow">
            <h3 class="text-2xl font-bold text-center mb-6">Member Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" required class="w-full mt-1 px-4 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password" required class="w-full mt-1 px-4 py-2 border rounded-lg">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Login</button>
            </form>
        </div>
    </div> --}}

    <!-- Footer -->
    <footer class="bg-white text-center py-6 mt-10 shadow-inner">
        <p class="text-gray-500">© {{ date('Y') }} Church CMS. All rights reserved.</p>
    </footer>

</body>
</html>