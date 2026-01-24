<x-app-layout>
    <x-slot name="title">My Dashboard</x-slot>

    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">My Classes</h2>
            <p class="text-slate-500">Pick up where you left off</p>
        </div>
        <a href="{{ route('classes.index') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow-lg shadow-indigo-200 text-sm font-medium transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Enroll New Class
        </a>
    </div>

    @if($classes->isEmpty())
    <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-slate-200">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-50 rounded-full mb-4 text-slate-400">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-1">No Classes Yet</h3>
        <p class="text-slate-500 text-sm mb-6 max-w-sm mx-auto">You haven't enrolled in any classes. Find your course code and join a class to get started.</p>
        <a href="{{ route('classes.index') }}" class="px-5 py-2.5 bg-indigo-50 text-indigo-600 rounded-lg font-medium hover:bg-indigo-100 transition">Browse Available Classes</a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($classes as $class)
        <a href="{{ route('courses.show', $class) }}" class="group block bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-teal-50 rounded-bl-full -mr-4 -mt-4 opacity-50 group-hover:scale-110 transition-transform"></div>

            <div class="relative z-10">
                <div class="flex items-start justify-between mb-4">
                    <span class="bg-teal-100 text-teal-700 px-3 py-1 rounded-full text-xs font-bold tracking-wide">
                        {{ $class->course->code }}
                    </span>
                    <span class="text-slate-400 text-xs font-medium">{{ $class->academic_year }}</span>
                </div>

                <h3 class="text-lg font-bold text-slate-800 group-hover:text-teal-600 transition-colors mb-1 line-clamp-1">
                    {{ $class->course->name }}
                </h3>
                <p class="text-slate-500 text-sm font-medium mb-6">{{ $class->name }} &bull; {{ $class->course->department }}</p>

                <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                    <span class="text-xs font-medium text-slate-500">
                        In Progress
                    </span>
                    <span class="text-teal-600 text-sm font-medium flex items-center gap-1 group-hover:gap-2 transition-all">
                        Go to Class <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</x-app-layout>