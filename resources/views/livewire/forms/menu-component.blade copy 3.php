<!-- resources/views/livewire/menu-component.blade.php -->

<div class="ml-4 mt-4 text-blue-500">
    {{ $selectedMenuId }}
    <ul class="flex space-x-4 space-y-2">

        @foreach ($menus as $menu)
            <li x-data="{ open: false }" @mouseover="open = true" @mouseleave="open = false">
                @if ($menu->url)
                    <div>
                        <a href="{{ $menu->url }}"
                            class="block py-2 px-4 leading-6 font-medium text-gray-900 hover:text-blue-600">{{ $menu->nombre }}</a>
                    </div>
                @else
                    <span
                        class="cursor-pointer block py-2 px-4 leading-6 font-medium text-gray-900">{{ $menu->nombre }}</span>
                @endif

                @if ($menu->children->isNotEmpty())
                    <ul x-show="open" class="pl-4">
                        @foreach ($menu->children as $submenu)
                            <li>
                                <a href="{{ $submenu->url }}"
                                    class="block py-2 px-4 leading-6 font-medium text-gray-900 hover:text-blue-600">{{ $submenu->nombre }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
