<div>
    <h1 class="text-2xl font-bold mb-4">Entidades</h1>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ciudad</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($entidades as $entidad)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $entidad->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $entidad->nombres }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $entidad->apellidos }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $entidad->eMail }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $entidad->direccion }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $entidad->ciudad }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $entidad->numero }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>