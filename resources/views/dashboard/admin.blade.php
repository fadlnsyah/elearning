<x-app-layout>
    <x-slot name="title">Admin Dashboard</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Stats -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="text-slate-500 text-sm font-medium">Total Users</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">{{ $totalUsers }}</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="text-slate-500 text-sm font-medium">Total Courses</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">{{ $totalCourses }}</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="text-slate-500 text-sm font-medium">Active Classes</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">{{ $totalClasses }}</div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-10 text-center">
        <h3 class="text-xl font-bold text-slate-800 mb-2">Welcome, Admin!</h3>
        <p class="text-slate-500 max-w-lg mx-auto">Use the sidebar menu to manage Users, Courses, and Classes. You can create, edit, and delete data from each respective section.</p>
    </div>
</x-app-layout>