@section('components.icontoggle-component')
<div class="flex items-center justify-between">
    <x-icon name="{{ $icon1 }}" />
    <x-button wire:click="toggle">
        <i class="fas fa-exchange-alt"></i>
    </x-button>
</div>
@endsection