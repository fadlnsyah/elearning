<x-app-layout>
    <x-slot name="title">{{ $courseClass->course->code }}</x-slot>

    <!-- Class Header -->
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm mb-8 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-indigo-50 to-violet-50 rounded-full -mr-32 -mt-32 opacity-70 group-hover:scale-105 transition-transform duration-700"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <span class="inline-block px-3 py-1 bg-indigo-600 text-white rounded-lg text-xs font-bold tracking-wide shadow-lg shadow-indigo-200">{{ $courseClass->course->department }}</span>
                <span class="text-slate-400 text-sm font-medium">{{ $courseClass->academic_year }}</span>
            </div>
            <h1 class="text-4xl font-bold text-slate-900 mb-2 tracking-tight">{{ $courseClass->course->name }}</h1>
            <p class="text-xl text-slate-500 mb-8">{{ $courseClass->name }}</p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('courses.assignments.index', $courseClass) }}" class="flex items-center gap-3 px-6 py-3 bg-white border border-slate-200 rounded-2xl font-semibold text-slate-700 hover:border-indigo-500 hover:text-indigo-600 hover:shadow-lg hover:shadow-indigo-50 transition-all">
                    <span class="p-1.5 bg-indigo-50 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </span>
                    Assignments
                </a>
                <a href="{{ route('courses.attendance.index', $courseClass) }}" class="flex items-center gap-3 px-6 py-3 bg-white border border-slate-200 rounded-2xl font-semibold text-slate-700 hover:border-indigo-500 hover:text-indigo-600 hover:shadow-lg hover:shadow-indigo-50 transition-all">
                    <span class="p-1.5 bg-teal-50 rounded-lg text-teal-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    Attendance
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Quick Stats / Next Up -->
        <div class="lg:col-span-2 space-y-6">
            <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Next Up
            </h3>

            <!-- Example Feed Item -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:border-indigo-100 transition-colors">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800">Welcome to {{ $courseClass->name }}</h4>
                        <p class="text-slate-500 text-sm mt-1">Make sure to check the Attendance tab for today's session code!</p>
                        <span class="text-xs text-slate-400 mt-2 block">{{ now()->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right: Info -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wide text-slate-400">Class Details</h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-center justify-between pb-4 border-b border-slate-50">
                        <span class="text-slate-500">Class Key</span>
                        <span class="font-mono bg-slate-100 px-2 py-1 rounded text-slate-600 text-xs">{{ $courseClass->enrollment_key }}</span>
                    </li>
                    <li class="flex items-center justify-between pb-4 border-b border-slate-50">
                        <span class="text-slate-500">Students</span>
                        <span class="font-medium text-slate-800">{{ $courseClass->users()->count() }} Enrolled</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-slate-500">Status</span>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-emerald-600 font-medium text-xs">Active</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>