<x-app-layout>
    <x-slot name="title">Edit Course</x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Edit Course: {{ $course->code }}</h3>

            <form action="{{ route('admin.courses.update', $course) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Course Code</label>
                        <input type="text" name="code" value="{{ $course->code }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Department</label>
                        <input type="text" name="department" value="{{ $course->department }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Course Name</label>
                    <input type="text" name="name" value="{{ $course->name }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <button class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Update Course</button>
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg font-medium transition">Cancel</a>
                </div>
            </form>
            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="mt-4 pt-4 border-t border-slate-100 text-center" onsubmit="return confirm('Are you sure? This will delete all classes in this course!');">
                @csrf
                @method('DELETE')
                <button class="text-rose-600 hover:text-rose-700 text-sm font-medium">Delete Course</button>
            </form>
        </div>
    </div>
</x-app-layout>