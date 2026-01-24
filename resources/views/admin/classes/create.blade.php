<x-app-layout>
    <x-slot name="title">Open New Class</x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Open New Class</h3>

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
                <div class="grid grid-cols-2 gap-4">
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

                <div class="flex items-center gap-3 pt-4">
                    <button class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Create Class</button>
                    <a href="{{ route('admin.classes.index') }}" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg font-medium transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>