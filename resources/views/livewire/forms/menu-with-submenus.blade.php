<div>
    <ul>
        @foreach ($menuItems as $menuItem)
            @if ($menuItem->has_submenus)
                <li>
                    <span>{{ $menuItem->name }}</span>
                    <ul>
                        @foreach ($menuItem->submenus as $submenu)
                            <li wire:click="$emit('submenuSelected', {{ $submenu->id }})">{{ $submenu->name }}</li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li wire:click="$emit('menuItemSelected', {{ $menuItem->id }})">{{ $menuItem->name }}</li>
            @endif
        @endforeach
    </ul>

    <div>
        @if ($submenuId)
            @livewire('submenu', ['submenuId' => $submenuId])
        @else
            @livewire('menu', ['menuItemId' => $menuItemId])
        @endif
    </div>
</div>
