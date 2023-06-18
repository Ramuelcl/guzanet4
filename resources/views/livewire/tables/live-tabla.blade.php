    <x-forms.contenedor01>
        <x-slot name="encabezado">
            {{ $encabezado }}
        </x-slot>
        <table>
            <!-- encabezados -->
            <x-slot name="titulos">
                <thead>
                    <tr>
                        @foreach ($titulos as $titulo)
                            <th colspan="2" class="text-center">{{ $titulo }}</th>
                        @endforeach
                    </tr>
                </thead>
            </x-slot>

            <!-- Contenido principal aquí -->
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        @foreach ($campos as $campo)
                            <td>{{ $item->$campo }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-forms.contenedor01>
