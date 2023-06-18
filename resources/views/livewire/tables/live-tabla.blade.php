    <x-forms.contenedor01>
        <!-- encabezados -->
        <x-slot name="encabezado">
            {{$encabezado}}
        </x-slot>
        <table>
            <thead>
                <x-slot name="titulos">
                    <tr>
                        @foreach($titulos as $titulo)
                        <th colspan="2" class="text-center">{{ $titulo }}</th>
                        @endforeach
                    </tr>
                </x-slot>
            </thead>

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
