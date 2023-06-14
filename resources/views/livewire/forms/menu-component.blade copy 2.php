<div>
    <ul class="flex space-y-4">
        @foreach ($menuItems as $index => $menuItem)
            <li>
                @if ($menuItem->url)
                    <a href="{{ $menuItem->url }}" class="text-blue-500 hover:text-blue-700"
                        @if ($menuItem->children->isNotEmpty()) wire:mouseover="hoverIndex = {{ $index }}"
                    wire:mouseout="hoverIndex = null" @endif>
                        {{ $menuItem->name }}
                    </a>
                @else
                    @if ($menuItem->children->isNotEmpty())
                        <ul class="pl-4" x-show="hoverIndex == {{ $index }}">
                            @foreach ($menuItem->children as $submenuItem)
                                <li>
                                    <a href="{{ $submenuItem->url }}" class="text-gray-500 hover:text-gray-700">
                                        {{ $submenuItem->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
</div>
