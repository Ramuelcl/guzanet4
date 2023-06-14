<!-- resources/views/components/nav-link.blade.php -->

@props(['href' => '/'])

<a {{ $attributes->merge(['class' => 'block py-2 px-4 leading-6 font-medium text-gray-900 hover:text-blue-600']) }}
    href="{{ $href }}">
    {{ $slot }}
</a>
