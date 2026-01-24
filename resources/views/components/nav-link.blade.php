@props(['active' => false])

<a {{ $attributes->merge(['class' => 'flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors ' . ($active ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900')]) }}>
    {{ $slot }}
</a>