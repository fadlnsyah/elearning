<x-app-layout>
    <x-slot name="title">{{ $assignment->title }}</x-slot>

    <div class="mb-8">
        <a href="{{ route('courses.assignments.index', $courseClass) }}" class="text-slate-500 hover:text-indigo-600 text-sm mb-3 inline-flex items-center gap-1 font-medium transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Assignments
        </a>
        <h2 class="text-3xl font-bold text-slate-900">{{ $assignment->title }}</h2>
        <div class="flex items-center gap-4 mt-3 text-sm text-slate-500">
            @if($assignment->due_date)
            <span class="flex items-center gap-1.5 bg-rose-50 text-rose-600 px-2.5 py-1 rounded-lg font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Due {{ $assignment->due_date->format('M d, Y H:i') }}
            </span>
            @endif
            <span class="capitalize bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg font-medium">{{ str_replace('_', ' ', $assignment->type) }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <div class="prose max-w-none text-slate-700 leading-relaxed">
                    {{ $assignment->description }}
                </div>

                @if($assignment->file_path)
                <div class="mt-8 pt-6 border-t border-slate-50">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 block">Attachment</label>
                    <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" class="inline-flex items-center px-4 py-3 bg-slate-50 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-100 hover:text-indigo-600 transition border border-slate-200">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download Resource
                    </a>
                </div>
                @endif
            </div>

            @if(Auth::user()->role === 'dosen')
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between mb-6 px-2">
                    <h3 class="font-bold text-lg text-slate-800">Student Submissions</h3>
                    <span class="text-sm text-slate-500 bg-slate-100 px-2 py-1 rounded-lg">{{ count($allSubmissions) }} submissions</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4 rounded-l-xl">Student</th>
                                <th class="px-6 py-4">Submitted At</th>
                                <th class="px-6 py-4">File</th>
                                <th class="px-6 py-4 rounded-r-xl">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($allSubmissions as $sub)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $sub->user->name }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $sub->submitted_at->diffForHumans() }}</td>
                                <td class="px-6 py-4">
                                    @if($sub->file_path)
                                    <a href="{{ asset('storage/' . $sub->file_path) }}" class="text-indigo-600 hover:text-indigo-700 font-medium underline decoration-indigo-200 hover:decoration-indigo-600 transition-all">Download</a>
                                    @else
                                    <span class="text-slate-400 italic">No file</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-lg bg-slate-100 text-slate-600 font-mono text-xs">{{ $sub->grade ?? 'Pending' }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">
                                    No students have submitted yet.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        <div>
            @if(Auth::user()->role === 'mahasiswa')
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm sticky top-24">
                <h3 class="font-bold text-lg mb-4 text-slate-800">Your Submission</h3>

                @if($submission)
                <div class="p-5 bg-emerald-50 text-emerald-800 rounded-2xl border border-emerald-100">
                    <div class="flex items-center gap-2 font-bold mb-2 text-emerald-700">
                        <span class="bg-emerald-200 text-emerald-700 rounded-full p-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        Submitted
                    </div>
                    <div class="text-sm opacity-90 mb-3 ml-7">{{ $submission->submitted_at->format('M d, Y H:i') }}</div>
                    @if($submission->file_path)
                    <a href="{{ asset('storage/' . $submission->file_path) }}" class="ml-7 inline-block text-sm font-medium underline decoration-emerald-300 hover:decoration-emerald-800 transition-all">View Uploaded File</a>
                    @endif
                </div>
                @else
                <form action="{{ route('courses.assignments.submit', [$courseClass, $assignment]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Notes (Optional)</label>
                        <textarea name="content" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all h-32 resize-none placeholder:text-slate-400" placeholder="Add any comments here..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Upload Work</label>
                        <div class="relative group">
                            <input type="file" name="file" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all border border-slate-200 rounded-xl cursor-pointer" required>
                        </div>
                    </div>
                    <button class="w-full py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all active:scale-[0.98]">Submit Assignment</button>
                </form>
                @endif
            </div>
            @endif
        </div>
    </div>
</x-app-layout>