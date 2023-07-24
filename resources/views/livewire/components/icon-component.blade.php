<!-- resources/views/livewire/components/icon-component.blade.php -->

@if ($iconName)
    @php
        $iconPath = "resources/svg/Icons/$iconName.svg";
    @endphp

    @if (file_exists(base_path($iconPath)))
        {!! file_get_contents(base_path($iconPath)) !!}
    @else
        <p>No se encontró el icono {{ $iconName }}.</p>
    @endif
@endif
