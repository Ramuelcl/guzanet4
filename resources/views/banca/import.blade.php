<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laravel 10 Import Export CSV And EXCEL File - Techsolutionstuff') }}
        </h2>
    </x-slot>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <!-- Formulario de importación -->
    <form method="POST" action="{{ route('import.traspaso.bancas') }}" enctype="multipart/form-data">

        @csrf

        <div class="mb-4">
            <x-input label="Archivo" placeholder="selecciona un archivo" type="file" name="archivo" required accept=".csv, .tsv, .txt" />
        </div>

        <div class="mb-4">
            <x-native-select label="Separador de campos" placeholder="Separador de campos" wire:model="separador_campos" name="separador_campos">
                <option value=",">Coma (,)</option>
                <option value=";" selected>Punto y coma (;)</option>
                <option value="\t">Tabulación(/t)</option>
            </x-native-select>
        </div>

        <div class="mb-4">
            <label for="saltos_linea">Saltos de línea:</label>
            <select name="saltos_linea" id="saltos_linea" required>
                <option value="\n">LF (Salto de línea /n)</option>
                <option value="\r">CR (Retorno de carro /r)</option>
                <option value="\r\n" selected>CR+LF (Retorno de carro + Salto de línea /r/n)</option>
                <option value="\x85">NEL (Nueva línea de siguiente línea /x85)</option>
                <option value="\u2028">LS (Separador de línea /u2028)</option>
                <option value="\x0B">VT (Tabulación vertical /x0B)</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="caracter_string" class="block">Carácter para los strings</label>
            <select id="caracter_string" name="caracter_string" class="w-full">
                <option value='"' selected>Comillas dobles (")</option>
                <option value="'">Comillas simples (')</option>
            </select>
        </div>


        <div class="mb-4">
            <label for="linea_datos">Línea donde comienzan los datos:</label>
            <input type="text" name="linea_datos" id="linea_datos" required value="7">
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Importar CSV/TSV</button>
        </div>
    </form>


    <!-- Formulario de exportación -->
</x-app-layout>