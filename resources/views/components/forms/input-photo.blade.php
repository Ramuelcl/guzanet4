@props(['disabled' => false])

<div class="mb-3">
    @if ($label)
        <label for="{{ $idName }}"
            class="inline-block w-30 mr-6 text-right text-sm font-medium text-neutral-700 dark:text-neutral-200">{{ $label }}</label>
    @endif
    @if ($value)
        {{ $value }}
    @endif
</div>
<div class="mt-1 flex items-center">
    <input type="file" name="{{ $idName }}" id="{{ $idName }}" wire:model.lazy="{{ $idName }}"
        value="{{ $value }}" {{ $disabled ? 'disabled' : '' }}
        class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary">

    <div>
        @if (!$value)
            <x-input-error for="{{ $idName }}" />
        @endif
    </div>
</div>

<div class="flex items-center space-x-6">
    <div class="shrink-0">
        @if()
        <img class="h-16 w-16 object-cover rounded-full"
            src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1361&q=80"
            alt="Current image" />
    </div>
    <label class="block">
        <span class="sr-only">__('Choose image')</span>
        <input type="file"
            class="block w-full text-sm text-slate-500
      file:mr-4 file:py-2 file:px-4
      file:rounded-full file:border-0
      file:text-sm file:font-semibold
      file:bg-violet-50 file:text-violet-700
      hover:file:bg-violet-100" />
    </label>
</div>
