<?php
// app/Http/Livewire/Components/TablaComponent.php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;

class TablaComponent extends Component
{
    use WithPagination;

    protected $data; // Variable para almacenar el nombre del modelo a consultar
    public $columnas; // Variable para almacenar las columnas de la tabla
    public $sortBy = 'id'; // Columna por defecto para el ordenamiento
    public $sortDirection = 'asc'; // Sentido del orden por defecto
    public $selectedItem = null; // Variable para almacenar el registro seleccionado
    public $frmFixeModal = null; // Agregamos la propiedad $frmFixeModal
    public $perPage = 5; // Número de registros por página
    public $currentPage = 1;
    public $isActiveOnly = null;

    protected $listeners = ['refreshList' => 'render'];

    public function mount($data, $columnas = [], $perPage, $isActiveOnly)
    {
        $this->data = $data;
        $this->columnas = $this->processColumns($columnas);
        if ($perPage !== $this->perPage) {
            $this->perPage = $perPage;
            $this->resetPage();
        }
    }

    public function render()
    {
        // Verificamos si el modelo es válido y si tiene las columnas para la tabla
        if (!empty($this->data)) {
            if (!empty($this->columnas)) {

                return view(
                    'livewire.components.tabla-component',
                    ['data' => $this->data, 'columnas' => $this->columnas]
                );
            }
        }

        // Si el modelo o las columnas no son válidas, retornamos una vista de error
        return view('livewire.components.tabla-component-error');
    }

    private function processColumns($columnas)
    {
        return collect($columnas)->map(function ($columna, $key) {
            $label = is_array($columna) && isset($columna['label'])  ? $columna['label'] : '';
            $sortBy = is_array($columna) && isset($columna['sortBy']) ? $columna['sortBy'] : false;
            $hidden = is_array($columna) && isset($columna['hidden']) ? $columna['hidden'] : false;
            $format = is_array($columna) && isset($columna['format']) ? $columna['format'] : null;

            return [
                'key' => $key,
                'label' => $label,
                'sortBy' => $sortBy,
                'hidden' => $hidden,
                'format' => $format,
            ];
        });
    }

    public function changePerPage($value)
    {
        // dd($value);
        $this->perPage = $value;
        $this->emit('changePerPage', $value);
    }
}
