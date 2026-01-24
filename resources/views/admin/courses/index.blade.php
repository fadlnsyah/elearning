<x-app-layout>
    <x-slot name="title">Manage Courses</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- List Courses -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden h-fit">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Course List</h3>
                <span class="text-xs font-semibold px-2 py-1 bg-white border border-slate-200 rounded-lg text-slate-500">Total: {{ $courses->count() }}</span>
            </div>
            <div class="divide-y divide-slate-100">
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

        <!-- Create Course Form -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm h-fit sticky top-24">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Create New Course</h3>
            <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Course Code</label>
                        <input type="text" name="code" placeholder="IFB-101" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Course Name</label>
                        <input type="text" name="name" placeholder="Algoritma" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Department</label>
                        <input type="text" name="department" placeholder="Informatika" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                </div>
                <button class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 transition-all mt-2">Create Course</button>
            </form>
        </div>
    </div>
</x-app-layout>