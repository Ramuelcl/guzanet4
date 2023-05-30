<div class="text-lg mx-4">
    contador
    <button wire:click="wc_inc_dec(+1)">+</button>{{ $counter }}
    <button wire:click="wc_inc_dec(-1)">-</button>
</div>