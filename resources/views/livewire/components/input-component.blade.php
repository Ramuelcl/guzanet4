{{-- views.livewire.components.input-component.blade.php --}}
<div class="flex mb-4">
    @if ($label)
        <div
            class="flex {{ $labelTextAlign === 'left' ? 'justify-start' : 'justify-end' }} items-center px-2 bg-gray-200 border border-r-2 border-gray-300 rounded-l-md dark:bg-gray-600 dark:border-gray-600 w-3/12">

            <label for="{{ $idName }}" class="text-sm text-gray-900  dark:text-gray-400 ">
                {{ $label }}
            </label>
        </div>
    @endif
    <input type="text" id="{{ $idName }}" name="{{ $idName }}" {{ $disabled == 1 ? 'disabled' : '' }}
        class="{{ $label ? 'rounded-none' : 'rounded-l-lg' }} {{ $disabled == 1 ? 'bg-gray-200' : 'bg-gray-50' }} rounded-r-{{ $icon ? 'none' : 'lg' }} border text-gray-800 focus:ring-blue-500 focus:border-blue-500 block flex-2 min-w-0 w-full text-sm
        border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
        dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="{{ $placeholder }}">
    @if ($icon)
        <div
            class="flex items-center px-2 bg-gray-200 border border-l-2 border-gray-300 rounded-r-lg dark:bg-gray-600 dark:border-gray-600 w-10">
            <livewire:components.icon-component :iconName="$icon" />
        </div>
    @endif
    @error($idName)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
