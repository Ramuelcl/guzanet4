{{-- views.livewire.components.input-component.blade.php --}}
<div class="flex mb-4">
    @if ($label)
        <label
            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 w-36">
            {{ $label }}
        </label>
    @endif
    <input type="text" id="{{ $idName }}" name="{{ $idName }}"
        class="{{ $label ? 'rounded-none' : 'rounded-l-lg' }} rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-2 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="{{ $placeholder }}"
        @error($idName)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror </div>