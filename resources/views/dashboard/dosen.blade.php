<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Teaching Classes</h2>
        <p class="text-slate-500">Manage your course materials and students</p>
    </div>

    @if($classes->isEmpty())
    <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-slate-200">
        <div class="text-slate-400 mb-2">No classes found</div>
        <p class="text-slate-500 text-sm mb-4">You haven't been assigned to any classes yet.</p>
        <a href="{{ route('classes.index') }}" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">Find & Enroll</a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($classes as $class)
        <a href="{{ route('courses.show', $class) }}" class="group block bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 opacity-50 group-hover:scale-110 transition-transform"></div>

            <div class="relative z-10">
                <div class="flex items-start justify-between mb-4">
                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold tracking-wide">
                        {{ $class->course->code }}
                    </span>
                    <span class="text-slate-400 text-xs font-medium">{{ $class->academic_year }}</span>
                </div>

                <h3 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors mb-1 line-clamp-1">
                    {{ $class->course->name }}
                </h3>
                <p class="text-slate-500 text-sm font-medium mb-6">{{ $class->name }} &bull; {{ $class->course->department }}</p>

                <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                    <div class="flex -space-x-2">
                        <!-- Fake avatars -->
                        <div class="w-6 h-6 rounded-full bg-slate-200 border-2 border-white"></div>
                        <div class="w-6 h-6 rounded-full bg-slate-300 border-2 border-white"></div>
                        <div class="w-6 h-6 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[10px] text-slate-500 font-bold">+</div>
                    </div>
                    <span class="text-indigo-600 text-sm font-medium flex items-center gap-1 group-hover:gap-2 transition-all">
                        Open Class <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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