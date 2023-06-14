<div class="ml-4 text-blue-500">
    <ul class="flex space-x-4">
        @foreach ($menuItems as $index => $menuItem)
            <li>
                @if ($menuItem['url'])
                    <a href="{{ $menuItem['url'] }}"
                        class="text-blue-500 hover:text-blue-700">{{ $menuItem['nombre'] }}</a>
                @else
                    {{-- @dump($menuItem['childrens'], sizeof($menuItem['childrens'])) --}}
                    @if ($menuItem['showSubmenu'])
                        <span class="text-blue-500 hover:text-blue-700 cursor-pointer">{{ $menuItem['nombre'] }}</span>
                        <ul>
                            @foreach ($menuItem['childrens'] as $index => $submenuItem)
                                <li>
                                    @if ($submenuItem['url'])
                                        <a href="{{ $submenuItem['url'] }}"
                                            wire:click="toggleSubmenu('{{ $submenuItem['id'] }}')">{{ $submenuItem['nombre'] }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
</div>
