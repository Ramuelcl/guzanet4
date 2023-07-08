<!-- resources/views/livewire/menu-component.blade.php -->

<div class="ml-4 mt-4 text-blue-500 relative">
    <ul class="{{ $orientation ? 'flex space-x-4' : 'space-y-1' }}">

        @foreach ($menus as $menu)
            <li x-data="{ open: false }" @mouseover="open = true" @mouseleave="open = false">
                @if ($menu['url'])
                    <x-nav-link :href="$menu['url']" :active="request()->is($menu['url'])"
                        class="{{ $orientation ? 'flex items-center' : '' }}">
                        <svg class="h-5 w-5 mr-2">
                            <use
                                xlink:href="{{ asset('storage/images/heroicons/solid/' . $menu['icono'] . '.svg#' . $menu['icono']) }}">
                            </use>
                        </svg>
                        <span>{{ fncTraduccion($menu['nombre']) }}</span>
                    </x-nav-link>
                @else
                    <span
                        class="cursor-pointer
                            block py-2 px-4 leading-6 font-medium text-gray-900">
                        {{ fncTraduccion($menu['nombre']) }}
                        {{-- <span>{{ session('locale') }}</span> --}}
                        @if ($menu['submenu'])
                            <ul x-show="open" class="left-0 mt-2 ml-2 bg-white shadow-md py-2 px-4 list-none"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95" @click.away="open = false"
                                @keydown.escape.window="open = false">
                                @foreach ($menu['submenu'] as $submenu)
                                    @if (substr($submenu['url'], 0, 10) == '/greeting/')
                                        @php
                                            $isCurrentLangue = $this->selectLangue($submenu['url']);
                                            // $menuUrl = substr($submenu['url'], 0, 9);
                                        @endphp
                                        {{-- <span>{{ $isCurrentLangue }}</span> --}}
                                        {{-- <span>{{ $menuUrl }}</span> <!-- Agregado para depurar --> --}}
                                        <li>
                                            <x-nav-link
                                                class="block py-2 px-4 leading-6 font-medium text-gray-900 hover:text-blue-600 {{ $isCurrentLangue ? 'flex items-center' : '' }}"
                                                href="{{ $submenu['url'] }}">
                                                @if ($isCurrentLangue)
                                                    <span class="mr-2 list-disc">&#8226;</span>
                                                @endif
                                                {{ fncTraduccion($submenu['nombre']) }}
                                            </x-nav-link>

                                        </li>
                                    @else
                                        <li>
                                            <x-nav-link
                                                class="block py-2 px-4 leading-6 font-medium text-gray-900 hover:text-blue-600"
                                                href="{{ $submenu['url'] }}">
                                                {{ fncTraduccion($submenu['nombre']) }}
                                            </x-nav-link>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
