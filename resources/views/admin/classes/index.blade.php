<x-app-layout>
    <x-slot name="title">Manage Classes</x-slot>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">Class List</h3>
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold px-2 py-1 bg-white border border-slate-200 rounded-lg text-slate-500">Total: {{ $classes->total() }}</span>
                <a href="{{ route('admin.classes.create') }}" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Class
                </a>
            </div>
        </div>
        <div class="divide-y divide-slate-100">
            @foreach($classes as $class)
            <div class="p-4 hover:bg-slate-50 transition-colors group">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-xs font-bold text-indigo-600 mb-0.5">{{ $class->course->code }} - {{ $class->course->name }}</div>
                        <div class="font-bold text-slate-800 text-sm">{{ $class->name }}</div>
                        <div class="text-xs text-slate-500 mt-1 flex items-center gap-2">
                            <span>{{ $class->academic_year }}</span>
                            <span class="text-slate-300">•</span>
                            <span class="font-medium text-slate-600">Key: {{ $class->enrollment_key }}</span>
                        </div>
                        @if($class->day)
                        <div class="mt-2 inline-flex items-center gap-1.5 px-2 py-1 rounded-lg bg-slate-100 border border-slate-200">
                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs font-medium text-slate-600">{{ $class->day }}, {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}</span>
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('admin.classes.edit', $class) }}" class="text-sm text-slate-400 hover:text-indigo-600 font-medium p-2 hover:bg-indigo-50 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $classes->links() }}
        </div>
    </div>
</x-app-layout>