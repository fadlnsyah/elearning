<x-app-layout>
    <x-slot name="title">Browse Classes</x-slot>

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Available Classes</h2>
            <p class="text-slate-500 text-sm">Find and enroll in your courses</p>
        </div>
        <form action="{{ route('classes.index') }}" method="GET" class="flex gap-2">
            <div class="relative">
                <input type="text" name="search" placeholder="Search code, name, department..." value="{{ request('search') }}" class="pl-10 pr-4 py-2 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 w-full md:w-72 transition-all">
                <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <button class="px-4 py-2 bg-slate-800 text-white rounded-xl font-medium hover:bg-slate-700 transition">Search</button>
        </form>
    </div>

    <div class="space-y-4">
        @forelse($classes as $class)
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-indigo-300 transition-colors">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">{{ $class->course->code }}</span>
                    <span class="text-xs text-slate-500 font-medium px-2 py-0.5 bg-slate-100 rounded-full">{{ $class->course->department }}</span>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-0.5">{{ $class->course->name }} <span class="text-slate-400 font-normal mx-1">/</span> {{ $class->name }}</h3>
                <div class="flex items-center gap-4 text-sm text-slate-500">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $class->academic_year }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{ $class->users_count ?? 0 }} Students
                    </span>
                </div>
            </div>
            <div>
                @if($class->users()->where('user_id', Auth::id())->exists())
                <a href="{{ route('courses.show', $class) }}" class="inline-flex items-center px-5 py-2.5 bg-emerald-50 text-emerald-600 rounded-xl text-sm font-semibold border border-emerald-100 hover:bg-emerald-100 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Enrolled
                </a>
                @else
                <form action="{{ route('classes.enroll', $class) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <div class="relative">
                        <input type="password" name="enrollment_key" placeholder="Enter Class Key" class="pl-9 pr-3 py-2.5 rounded-xl border border-slate-200 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 w-40 transition-all">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <button class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition">Enroll Now</button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-12 text-slate-500">
            No classes found matching your search.
        </div>
        @endforelse
    </div>
</x-app-layout>