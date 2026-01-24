<x-app-layout>
    <x-slot name="title">Manage Courses</x-slot>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">Course List</h3>
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold px-2 py-1 bg-white border border-slate-200 rounded-lg text-slate-500">Total: {{ $courses->count() }}</span>
                <a href="{{ route('admin.courses.create') }}" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Course
                </a>
            </div>
        </div>
        <div class="divide-y divide-slate-100 max-h-[calc(100vh-12rem)] overflow-y-auto">
            @foreach($courses as $course)
            <div class="p-4 hover:bg-slate-50 transition-colors group">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-800">{{ $course->code }}</span>
                            <span class="text-slate-300">|</span>
                            <span class="text-slate-700 font-medium">{{ $course->name }}</span>
                        </div>
                        <div class="text-xs text-slate-500 mt-0.5">{{ $course->department }}</div>
                    </div>
                    <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm text-slate-400 hover:text-indigo-600 font-medium p-2 hover:bg-indigo-50 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>