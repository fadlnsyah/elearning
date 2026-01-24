<x-app-layout>
    <x-slot name="title">Create Course</x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Create New Course</h3>

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

                <div class="flex items-center gap-3 pt-4">
                    <button class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Create Course</button>
                    <a href="{{ route('admin.courses.index') }}" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg font-medium transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>