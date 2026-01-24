<x-app-layout>
    <x-slot name="title">{{ $courseClass->course->name }} - Attendance</x-slot>

    <div class="mb-8 flex justify-between items-center">
        <div>
            <a href="{{ route('courses.show', $courseClass) }}" class="text-slate-500 hover:text-indigo-600 text-sm mb-2 inline-flex items-center gap-1 font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Class
            </a>
            <h2 class="text-2xl font-bold text-slate-800">Attendance Records</h2>
        </div>
    </div>

    <!-- Student Submit Section -->
    @if(Auth::user()->role === 'mahasiswa')
    <div class="bg-indigo-600 p-8 rounded-3xl shadow-xl shadow-indigo-200 text-white mb-10 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
                <h3 class="font-bold text-2xl mb-2">Check In Here</h3>
                <p class="text-indigo-100 max-w-md">Is there an active session? Select the session and enter the code provided by your lecturer.</p>
            </div>

            <form action="{{ route('courses.attendance.submit', $courseClass) }}" method="POST" class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/20 w-full md:w-96">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-indigo-100 mb-1">Select Session</label>
                        <select name="attendance_id" class="w-full px-4 py-2.5 rounded-xl border border-indigo-400 bg-white/10 text-white placeholder-indigo-300 focus:bg-white/20 focus:border-white outline-none transition-all [&>*]:text-slate-800" required>
                            @foreach($attendances as $attendance)
                            @php
                            // Simple check, real app needs robust time check
                            $start = \Carbon\Carbon::parse($attendance->date->format('Y-m-d') . ' ' . $attendance->start_time);
                            $end = \Carbon\Carbon::parse($attendance->date->format('Y-m-d') . ' ' . $attendance->end_time);
                            $isOpen = now()->between($start, $end);
                            @endphp
                            @if($isOpen)
                            <option value="{{ $attendance->id }}">{{ $attendance->title }} (Open Now)</option>
                            @endif
                            @endforeach
                            <option value="" disabled selected>-- Select Active Session --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-indigo-100 mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-indigo-400 bg-white/10 text-white placeholder-indigo-300 focus:bg-white/20 focus:border-white outline-none transition-all [&>*]:text-slate-800" required>
                            <option value="present">Present (Hadir)</option>
                            <option value="excused">Excused (Izin)</option>
                            <option value="absent">Absent (Sakit/Alpha)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-indigo-100 mb-1">Secret Code</label>
                        <input type="text" name="secret_code" placeholder="Enter session code" class="w-full px-4 py-2.5 rounded-xl border border-indigo-400 bg-white/10 text-white placeholder-indigo-300 focus:bg-white/20 focus:border-white outline-none transition-all">
                    </div>
                    <button class="w-full py-2.5 bg-white text-indigo-600 rounded-xl font-bold hover:bg-indigo-50 transition shadow-lg">Submit Attendance</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Teacher Create Section -->
    @if(Auth::user()->role === 'dosen')
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm mb-10">
        <h3 class="font-bold text-lg mb-4 text-slate-800">Create New Session</h3>
        <form action="{{ route('courses.attendance.store', $courseClass) }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            @csrf
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Title</label>
                <input type="text" name="title" placeholder="Pertemuan 1" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Date</label>
                <input type="date" name="date" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
            </div>
            <div class="md:col-span-2 grid grid-cols-2 gap-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Start</label>
                    <input type="time" name="start_time" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">End</label>
                    <input type="time" name="end_time" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500" required>
                </div>
            </div>
            <div class="md:col-span-4">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Secret Code (Optional)</label>
                <input type="text" name="secret_code" placeholder="e.g. A1B2" class="w-full px-3 py-2 rounded-lg border border-slate-200 outline-none focus:border-indigo-500">
            </div>
            <div>
                <button class="w-full py-2 bg-slate-800 text-white rounded-lg font-medium hover:bg-slate-700 transition">Create</button>
            </div>
        </form>
    </div>
    @endif

    <!-- History -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-bold text-slate-800">Session History</h3>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total {{ count($attendances) }} Sessions</span>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($attendances as $attendance)
            <div class="p-6 hover:bg-slate-50 transition-colors group">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h4 class="font-bold text-slate-800 text-lg">{{ $attendance->title }}</h4>
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-500 border border-slate-200">
                                {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                            </span>
                        </div>
                        <div class="text-sm text-slate-500 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i') }}
                            @if(Auth::user()->role === 'dosen' && $attendance->secret_code)
                            <span class="ml-2 px-2 py-0.5 bg-yellow-50 text-yellow-700 rounded text-xs font-mono border border-yellow-100">Code: {{ $attendance->secret_code }}</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        @if(Auth::user()->role === 'mahasiswa')
                        @php
                        // Simple check, real app needs robust time check
                        $start = \Carbon\Carbon::parse($attendance->date->format('Y-m-d') . ' ' . $attendance->start_time);
                        $end = \Carbon\Carbon::parse($attendance->date->format('Y-m-d') . ' ' . $attendance->end_time);
                        $isOpen = now()->between($start, $end);
                        $record = $attendance->records()->where('user_id', Auth::id())->first();
                        @endphp
                        @if($record)
                        <span class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl font-bold text-sm border border-emerald-100">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ ucfirst($record->status) }}
                        </span>
                        @else
                        @if($isOpen)
                        <span class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl font-bold text-sm border border-indigo-100 animate-pulse">
                            Open for Check-in
                        </span>
                        @else
                        <span class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-500 rounded-xl font-medium text-sm border border-slate-200">
                            Absent / Missed
                        </span>
                        @endif
                        @endif
                        @else
                        <div class="text-right">
                            <div class="text-2xl font-bold text-slate-800">{{ $attendance->records()->count() }}</div>
                            <div class="text-xs text-slate-500 uppercase font-bold tracking-wider">Present</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-slate-400">No attendance sessions recorded yet.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>