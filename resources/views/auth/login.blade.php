<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - E-Kampus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-900">Welcome Back</h1>
                <p class="text-sm text-slate-500 mt-2">Sign in to E-Kampus Access</p>
            </div>

            @if($errors->any())
            <div class="mb-4 p-3 bg-rose-50 text-rose-600 text-sm rounded-lg">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Username or Email</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all placeholder:text-slate-400" placeholder="Enter your ID" required autofocus>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all placeholder:text-slate-400" placeholder="••••••••" required>
                </div>
                <button class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold transition-all shadow-lg shadow-indigo-600/20 active:scale-[0.98]">
                    Sign In
                </button>
            </form>
        </div>
        <div class="px-8 py-4 bg-slate-50 border-t border-slate-100 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} E-Kampus System. All rights reserved.
        </div>
    </div>
</body>

</html>