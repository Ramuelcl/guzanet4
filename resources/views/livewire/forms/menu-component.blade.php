<!-- resources/views/livewire/menu-component.blade.php -->

<div class="ml-4 mt-4 text-blue-500 relative">
    <ul class="{{ $orientation ? 'flex space-x-4' : 'space-y-2' }}">

        @foreach ($menus as $menu)
            <li x-data="{ open: false }" @mouseover="open = true" @mouseleave="open = false">
                @if ($menu->url)
                    <x-nav-link :href="$menu->url" :active="request()->is($menu->url)"
                        class="{{ $orientation ? 'flex items-center' : '' }}">
                        <svg class="h-5 w-5 mr-2">
                            <use
                                xlink:href="{{ asset('storage/images/heroicons/solid/' . $menu->icon . '.svg#' . $menu->icon) }}">
                            </use>
                        </svg>
                        <span>{{ $menu->nombre }}</span>
                    </x-nav-link>
                @else
                    <span
                        class="cursor-pointer
                            block py-2 px-4 leading-6 font-medium text-gray-900">{{ $menu->nombre }}</span>
                @endif

                @if ($menu->children->isNotEmpty())
                    <ul x-show="open" class="left-0 mt-2 ml-2 bg-white shadow-md py-2 px-4">
                        @foreach ($menu->children as $submenu)
                            <li>
                                <x-nav-link
                                    class="block py-2 px-4 leading-6 font-medium text-gray-900 hover:text-blue-600"
                                    href="{{ $submenu->url }}">{{ $submenu->nombre }}
                                </x-nav-link>

                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
