<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Kampus E-Learning') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased" x-data="{ sidebarOpen: true }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <!-- Toggle classes based on state: 
             Desktop: w-64 when open, w-0/hidden when closed 
             Mobile: Fixed overlay when open, hidden when closed 
        -->
        <aside
            :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full md:translate-x-0 md:!w-0 md:border-r-0'"
            class="fixed inset-y-0 left-0 z-50 bg-white border-r border-slate-200 flex flex-col shrink-0 transition-all duration-300 ease-in-out md:relative shadow-lg md:shadow-none overflow-hidden">
            <div class="h-16 flex items-center justify-between px-6 border-b border-slate-100">
                <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">E-Kampus</span>
                <!-- Mobile Close Button -->
                <button @click="sidebarOpen = false" class="md:hidden text-slate-500 hover:text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-nav-link>

                @if(Auth::user()->role !== 'admin')
                <div class="pt-4 pb-1 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    My Classes
                </div>
                @foreach(Auth::user()->classes as $class)
                <x-nav-link :href="route('courses.show', $class)" :active="request()->is('class/'.$class->id.'*')">
                    {{ $class->course->code }} - {{ $class->name }}
                </x-nav-link>
                @endforeach

                <div class="pt-4 pb-1 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Enrollment
                </div>
                <x-nav-link :href="route('classes.index')" :active="request()->routeIs('classes.index')">
                    Browse Classes
                </x-nav-link>
                @endif

                @if(Auth::user()->role === 'admin')
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Admin Dashboard
                </x-nav-link>
                @endif
            </div>
            <div class="p-4 border-t border-slate-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center justify-start px-3 py-2 text-sm font-medium text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-slate-900/50 z-40 md:hidden" style="display: none;"></div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden min-w-0 transition-all duration-300">
            <!-- Navbar -->
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 z-10 sticky top-0">
                <div class="flex items-center gap-4">
                    <!-- Toggle Button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-indigo-600 p-1 rounded-lg hover:bg-indigo-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="text-lg font-medium text-slate-800">
                        {{ $title ?? 'Dashboard' }}
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-medium text-slate-700">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-slate-500 capitalize">{{ Auth::user()->role }}</div>
                    </div>
                    <div class="h-9 w-9 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold border border-indigo-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Content Scrollable -->
            <div class="flex-1 overflow-y-auto p-4 sm:p-6 scroll-smooth">
                <div class="max-w-7xl mx-auto">
                    @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-100 flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="mb-6 p-4 bg-rose-50 text-rose-700 rounded-xl border border-rose-100 flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 text-rose-700 rounded-xl border border-rose-100">
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>

</html>