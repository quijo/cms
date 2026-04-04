<x-app-layout>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

        <!-- Mobile sidebar -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-40 flex md:hidden" x-cloak>
            <!-- Overlay -->
            <div @click="sidebarOpen = false" class="fixed inset-0 bg-black opacity-50"></div>

            <!-- Sidebar panel -->
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                <x-sidebar :links="$sidebarLinks" />
            </div>
        </div>

        <!-- Desktop sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <x-sidebar :links="$sidebarLinks" />
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-auto">
            <!-- Header -->
            <header class="w-full h-16 flex items-center justify-between px-4 bg-white border-b md:hidden">
                <button @click="sidebarOpen = true" class="text-gray-700 focus:outline-none">
                    <!-- Hamburger Icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-xl font-bold">Dashboard</h1>
            </header>

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-app-layout>