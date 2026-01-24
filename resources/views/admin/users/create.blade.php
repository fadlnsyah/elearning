<x-app-layout>
    <x-slot name="title">Create User</x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Create New User</h3>

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
                    <label class="block text-sm font-medium text-slate-700 mb-1">Identity Number (NIM/NID)</label>
                    <input type="text" name="identity_number" placeholder="Optional for Admin" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500">
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

                <div class="flex items-center gap-3 pt-4">
                    <button class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Create User</button>
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg font-medium transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>