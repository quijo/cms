<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg hidden md:block">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold">Church CMS</h2>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
               Dashboard
            </a>

            @can('view announcements')
            <a href="{{ route('announcements.index') }}"
               class="block px-4 py-2 rounded-lg {{ request()->routeIs('announcements.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
               Announcements
            </a>
            @endcan

            @can('view articles')
            <a href="{{ route('articles.index') }}"
               class="block px-4 py-2 rounded-lg {{ request()->routeIs('articles.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
               Articles
            </a>
            @endcan

            @can('view members')
            <a href="{{ route('members.index') }}"
               class="block px-4 py-2 rounded-lg {{ request()->routeIs('members.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
               Members
            </a>
            @endcan

            @role('Admin')
            <a href="{{ route('users.index') }}"
               class="block px-4 py-2 rounded-lg {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
               Users
            </a>
            @endrole
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold">{{ $title ?? 'Dashboard' }}</h1>

            <div class="flex items-center space-x-4">
                <span>{{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">Logout</button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6">
            {{ $slot }}
        </main>

    </div>
</div>

</body>
</html>