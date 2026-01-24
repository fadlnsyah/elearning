<x-app-layout>
    <x-slot name="title">Edit User</x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Edit User: {{ $user->name }}</h3>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                        <select name="role" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500 bg-white" required>
                            <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="dosen" {{ $user->role == 'dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Identity Number (NIM/NID)</label>
                    <input type="text" name="identity_number" value="{{ $user->identity_number }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                    <input type="text" name="username" value="{{ $user->username }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password <span class="text-slate-400 font-normal">(Leave blank to keep current)</span></label>
                    <input type="password" name="password" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500">
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <button class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Update User</button>
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg font-medium transition">Cancel</a>

                </div>
            </form>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="mt-4 pt-4 border-t border-slate-100 text-center" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button class="text-rose-600 hover:text-rose-700 text-sm font-medium">Delete User</button>
            </form>
        </div>
    </div>
</x-app-layout>