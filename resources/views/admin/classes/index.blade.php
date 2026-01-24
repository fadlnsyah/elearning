<x-app-layout>
    <x-slot name="title">Manage Classes</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- List Classes -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden h-fit">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Class List</h3>
                <span class="text-xs font-semibold px-2 py-1 bg-white border border-slate-200 rounded-lg text-slate-500">Total: {{ $classes->total() }}</span>
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

        <!-- Create Class Form -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm h-fit sticky top-24">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Open New Class</h3>
            <form action="{{ route('admin.classes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Select Course</label>
                    <select name="course_id" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500 bg-white" required>
                        @foreach($courses as $c)
                        <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Class Name</label>
                        <input type="text" name="name" placeholder="Kelas A" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Academic Year</label>
                        <input type="text" name="academic_year" placeholder="2025/2026" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Enrollment Key</label>
                    <input type="text" name="enrollment_key" placeholder="Secret Key" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Day</label>
                        <select name="day" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500 bg-white">
                            <option value="">- Select -</option>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Start</label>
                        <input type="time" name="start_time" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">End</label>
                        <input type="time" name="end_time" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500">
                    </div>
                </div>
                <button class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 transition-all mt-2">Create Class</button>
            </form>
        </div>
    </div>
</x-app-layout>