<x-app-layout>
    <x-slot name="title">Profile</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-6 mb-8">
                    <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-3xl font-bold overflow-hidden border-4 border-white shadow-lg shrink-0">
                        @if($user->avatar)
                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" class="w-full h-full object-cover">
                        @else
                        {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">{{ $user->name }}</h2>
                        <div class="text-slate-500 font-medium">{{ $user->email }}</div>
                        @if($user->identity_number)
                        <div class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-indigo-50 text-indigo-700">
                            {{ $user->identity_number }}
                        </div>
                        @endif
                        <div class="text-xs text-slate-400 mt-1 capitalize">{{ $user->role }}</div>
                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Change Profile Photo</label>
                        <div class="flex items-center gap-4">
                            <input type="file" name="avatar" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all border border-slate-200 rounded-xl cursor-pointer">
                        </div>
                        <p class="mt-2 text-xs text-slate-500">JPG, PNG or GIF (Max. 2MB)</p>
                    </div>

                    <div class="pt-4 border-t border-slate-50">
                        <button class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">Save Changes</button>
                    </div>
                </form>
            </div>
            <div class="px-8 py-4 bg-slate-50 border-t border-slate-100 text-sm text-slate-500">
                To update your Name or Identity Number, please contact the Administrator.
            </div>
        </div>
    </div>
</x-app-layout>