<x-app-layout>
    <x-slot name="title">Admin Dashboard</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Stats -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="text-slate-500 text-sm font-medium">Total Users</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">{{ \App\Models\User::count() }}</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="text-slate-500 text-sm font-medium">Total Courses</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">{{ \App\Models\Course::count() }}</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="text-slate-500 text-sm font-medium">Active Classes</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">{{ \App\Models\CourseClass::count() }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Create User -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm h-fit">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Create New User</h3>
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="name" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                        <select name="role" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500 bg-white" required>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="dosen">Dosen</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                    <input type="text" name="username" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>
                <button class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Create User</button>
            </form>
        </div>

        <!-- Create Course & Class -->
        <div class="space-y-8">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Create Course (Mata Kuliah)</h3>
                <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Course Code</label>
                            <input type="text" name="code" placeholder="IFB-101" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Department</label>
                            <input type="text" name="department" placeholder="Informatika" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Course Name</label>
                        <input type="text" name="name" placeholder="Algoritma" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                    <button class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Create Course</button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Open New Class</h3>
                <form action="{{ route('admin.classes.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Select Course</label>
                        <select name="course_id" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500 bg-white" required>
                            @foreach(\App\Models\Course::all() as $c)
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
                    <button class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Create Class</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>