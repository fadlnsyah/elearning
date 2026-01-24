<x-app-layout>
    <x-slot name="title">Manage Users</x-slot>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">User List</h3>
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold px-2 py-1 bg-white border border-slate-200 rounded-lg text-slate-500">Total: {{ $users->total() }}</span>
                <a href="{{ route('admin.users.create') }}" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New User
                </a>
            </div>
        </div>
        <div class="divide-y divide-slate-100">
            @foreach($users as $user)
            <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-sm shrink-0">
                        @if($user->avatar)
                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" class="w-full h-full rounded-full object-cover">
                        @else
                        {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <div class="font-bold text-slate-800 text-sm flex items-center gap-2">
                            {{ $user->name }}
                            @if($user->identity_number)
                            <span class="text-xs font-normal text-slate-400 bg-slate-100 px-1.5 rounded">{{ $user->identity_number }}</span>
                            @endif
                        </div>
                        <div class="text-xs text-slate-500">{{ $user->email }}</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-2 py-0.5 rounded text-xs font-medium bg-indigo-50 text-indigo-700 capitalize">{{ $user->role }}</span>
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-sm text-slate-400 hover:text-indigo-600 font-medium p-2 hover:bg-indigo-50 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>