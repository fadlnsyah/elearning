<x-app-layout>
    <x-slot name="title">Edit Class</x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Edit Class: {{ $courseClass->name }}</h3>

            <form action="{{ route('admin.classes.update', $courseClass) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Select Course</label>
                    <select name="course_id" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500 bg-white" required>
                        @foreach($courses as $c)
                        <option value="{{ $c->id }}" {{ $courseClass->course_id == $c->id ? 'selected' : '' }}>{{ $c->code }} - {{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Class Name</label>
                        <input type="text" name="name" value="{{ $courseClass->name }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Academic Year</label>
                        <input type="text" name="academic_year" value="{{ $courseClass->academic_year }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Enrollment Key</label>
                    <input type="text" name="enrollment_key" value="{{ $courseClass->enrollment_key }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>

                <div class="pt-4 border-t border-slate-50">
                    <h4 class="text-sm font-bold text-slate-800 mb-3">Class Schedule</h4>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1">Day</label>
                            <select name="day" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500 bg-white">
                                <option value="">- Select -</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                                <option value="{{ $day }}" {{ $courseClass->day == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1">Start Time</label>
                            <input type="time" name="start_time" value="{{ $courseClass->start_time ? \Carbon\Carbon::parse($courseClass->start_time)->format('H:i') : '' }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1">End Time</label>
                            <input type="time" name="end_time" value="{{ $courseClass->end_time ? \Carbon\Carbon::parse($courseClass->end_time)->format('H:i') : '' }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <button class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Update Class</button>
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg font-medium transition">Cancel</a>
                </div>
            </form>
            <form action="{{ route('admin.classes.destroy', $courseClass) }}" method="POST" class="mt-4 pt-4 border-t border-slate-100 text-center" onsubmit="return confirm('Are you sure you want to delete this class?');">
                @csrf
                @method('DELETE')
                <button class="text-rose-600 hover:text-rose-700 text-sm font-medium">Delete Class</button>
            </form>
        </div>
    </div>
</x-app-layout>