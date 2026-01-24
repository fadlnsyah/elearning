<x-app-layout>
    <x-slot name="title">{{ $courseClass->course->name }} - Assignments</x-slot>

    <div class="mb-8 flex justify-between items-end">
        <div>
            <a href="{{ route('courses.show', $courseClass) }}" class="text-slate-500 hover:text-indigo-600 text-sm mb-2 inline-flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Class
            </a>
            <h2 class="text-2xl font-bold text-slate-800">Assignments</h2>
        </div>
    </div>

    @if(Auth::user()->role === 'dosen')
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm mb-8">
        <h3 class="font-bold text-lg mb-4 text-slate-800">Create New Assignment</h3>
        <form action="{{ route('courses.assignments.store', $courseClass) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Title</label>
                    <input type="text" name="title" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Due Date</label>
                    <input type="datetime-local" name="due_date" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Description</label>
                <textarea name="description" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 transition-all h-24 resize-none"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Type</label>
                    <select name="type" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 bg-white transition-all">
                        <option value="file_upload">File Upload Submission</option>
                        <option value="quiz">Quiz (Simple)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Attachment (Optional)</label>
                    <input type="file" name="file" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                </div>
            </div>
            <div class="pt-2">
                <button class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">Publish Assignment</button>
            </div>
        </form>
    </div>
    @endif

    <div class="space-y-4">
        @forelse($assignments as $assignment)
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-indigo-300 transition-colors">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    @if($assignment->type === 'quiz')
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-100">Quiz</span>
                    @else
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">Assignment</span>
                    @endif
                    @if($assignment->due_date)
                    <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Due {{ $assignment->due_date->format('M d, H:i') }}
                    </span>
                    @endif
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $assignment->title }}</h3>
                <p class="text-sm text-slate-500 line-clamp-2 max-w-2xl">{{ $assignment->description }}</p>
            </div>
            <div>
                <a href="{{ route('courses.assignments.show', [$courseClass, $assignment]) }}" class="inline-flex items-center px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl text-sm font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    View Details
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-12 text-slate-400">
            No assignments published yet.
        </div>
        @endforelse
    </div>
</x-app-layout>