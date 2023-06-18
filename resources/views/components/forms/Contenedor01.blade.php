<!-- resources\views\components\contenedor01.blade.php -->
<div class="border border-blue-300 rounded-3xl overflow-hidden shadow-lg flex flex-col h-full mx-4 my-2">
    <div class="bg-blue-300 text-white text-center py-1 rounded-t">
        <div class="flex justify-between items-center px-4">
            <h2 class="text-xl font-bold">{{ $encabezado ?? 'Encabezado' }}</h2>
            <button class="p-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        @if (isset($titulos))
        <div class="bg-transparent border-t-2 border-blue-300">
            <p class="text-sm font-semibold text-blue-700">{{ $titulos }}</p>
            @endif
        </div>
    </div>

    <div class="p-8 flex-grow flex items-center">
        {{ $slot }}
    </div>

    @if (isset($pie))
    <div class="border-t border-blue-300"></div>

    <div class="bg-blue-300 text-white text-center py-2 rounded-b">
        <p class="text-lg font-bold">{{ $pie ??null}}</p>
    </div>
    @endif
</div>
