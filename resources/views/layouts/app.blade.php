<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
</head>

<body class="bg-gray-100">

<div x-data="{ open: false }" class="flex min-h-screen">

    <!-- Sidebar -->
    <aside
        :class="open ? 'block' : 'hidden'"
        class="w-64 bg-white shadow-lg fixed inset-y-0 left-0 z-50 md:static md:block">

        <div class="p-6 border-b flex justify-between items-center">
            <h2 class="text-xl font-bold">Church CMS</h2>

            <!-- Close button (mobile) -->
            <button @click="open = false" class="md:hidden text-gray-500">
                ✕
            </button>
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
            
              <a href="{{ route('churches.index') }}"
               class="block px-4 py-2 rounded-lg {{ request()->routeIs('churches.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
               Churches
            </a>

            <a href="{{ route('pastors.index') }}"
               class="block px-4 py-2 rounded-lg {{ request()->routeIs('pastors.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
               Pastors
            </a>

            <a href="{{ route('givings.index') }}"
               class="block px-4 py-2 rounded-lg {{ request()->routeIs('givings.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
               Givings
            </a>

            @endrole
            
        </nav>
    </aside>

    <!-- Overlay (mobile) -->
    <div x-show="open" @click="open = false"
         class="fixed inset-0 bg-black opacity-50 z-40 md:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">

            <div class="flex items-center space-x-4">
                <!-- Burger button -->
                <button @click="open = true"
                        class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <h1 class="text-lg font-semibold">{{ $title ?? 'Dashboard' }}</h1>
            </div>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            let id = this.dataset.id;

            Swal.fire({
                title: "Delete Member?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-member-' + id).submit();
                }
            });

        });
    });

});
</script>
</body>
</html>