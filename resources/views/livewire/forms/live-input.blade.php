@props(['disabled' => false])
{{-- @dd($icono) --}}
<div>
    <div class="flex">
        <span
            class="w-{{ $label ? 3 : 1 }}/12 inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
            @if ($label)
                {{ $label }}
            @elseif ($icono)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" d="{{ $ico ? $icono[0] : $icono[1] }}" />
                </svg>
            @endif
        </span>
        <input type="{{ $type }}" id="{{ $idName }}" name="{{ $idName }}"
            wire:model="{{ $idName }}"
            {{ $attributes->merge(['class' => 'rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}
            placeholder="{{ $placeholder }}" {{ $disabled ? 'disabled' : '' }}>
    </div>
</div>
