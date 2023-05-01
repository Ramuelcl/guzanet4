@props(['disabled' => false])
<!-- <div>
    <div class="relative mt-2 grid grid-flow-col grid-cols-2">
        <span class="inline-block w-20 mr-6 text-right text-sm font-medium bg-gray-100  items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200" id="basic-addon1">{{ $label }}</span>
        <input type="{{ $type }}" name="{{ $idName }}" id="{{ $idName }}" wire:model.lazy="{{ $idName }}" value="{{$value}}" placeholder="{{ $placeholder }}" {{ $disabled ? 'disabled' : '' }} class="relative w-full rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" aria-label="{{ $idName }}" aria-describedby="basic-addon1" />
    </div>
    <x-input-error for="{{ $idName }}" />
</div> -->

<!-- component -->
<div class="flex items-start">
    <div class="w-40 px-0 py-0 align-baseline">{{$label}}</div>
    <div class="flex-1">
        <input type="{{ $type }}" name="{{ $idName }}" id="{{ $idName }}" wire:model.lazy="{{ $idName }}" value="{{$value}}" placeholder="{{ $placeholder }}" {{ $disabled ? 'disabled' : '' }} class="w-full border shadow-sm px-3 py-2 rounded-md appearance-none placeholder-gray-500 dark:bg-dark-2 dark:border-transparent" />
        <x-input-error for="{{ $idName }}" />
    </div>
</div>