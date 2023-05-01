@props(['disabled' => false])

<div class="mb-3">
    @if ($label)
    <label for="{{ $idName }}" class="inline-block w-30 mr-6 text-right text-sm font-medium text-neutral-700 dark:text-neutral-200">{{ $label }}</label>
    @endif
    @if ($value)
    {{$value}}
    @endif
</div>
<div class="mt-1 flex items-center">
    <input type="file" name="{{ $idName }}" id="{{ $idName }}" wire:model.lazy="{{ $idName }}" value="{{ $value }}" {{ $disabled ? 'disabled' : '' }} class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary">

    <div>
        @if(!$value)
        <x-input-error for="{{ $idName }}" />
        @endif
    </div>
</div>