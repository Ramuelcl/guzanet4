<div>
    <label for="search" class="sr-only">Search</label>
    <div class="relative mt-1">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-800 dark:text-gray-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <input wire:model.lazy="search" type="search" id="search" class="h-9 pl-9 bg-gray-50 border text-gray-800 dark:bg-gray-800 dark:text-gray-50 text-sm rounded-lg focus:ring-blue-500 dark:focus:ring-blue-500" placeholder="{{ __('Search for items') }}">
        <!-- {{$this->fields}} -->
    </div>
</div>