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
    public $isActiveOnly = null;

    protected $listeners = ['changePerPage', 'refreshList' => 'render'];

    public function mount($data, $columnas = [], $perPage, $isActiveOnly)
    {
        $this->data = $data;
        $this->columnas = $this->processColumns($columnas);
        $this->perPage = $perPage;
        $this->$isActiveOnly = $isActiveOnly;
    }

    public function render()
    {
        // Verificamos si el modelo es válido y si tiene las columnas para la tabla
        if (!empty($this->data) && !empty($this->columnas)) {
            $data = $this->data;
            $columnas = $this->columnas;

            // Consultamos los datos del modelo paginados y ordenados
            // $data = $modelo::orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);

            return view('livewire.components.tabla-component', compact('data', 'columnas'));
        }

        // Si el modelo o las columnas no son válidas, retornamos una vista de error
        return view('livewire.components.tabla-component-error');
    }

    private function processColumns($columnas)
    {
        return collect($columnas)->map(function ($columna, $key) {
            $label = is_array($columna) && isset($columna['label'])  ? $columna['label'] : '';
            $sortBy = is_array($columna) && isset($columna['sortBy']) ? $columna['sortBy'] : false;
            $isHidden = is_array($columna) && isset($columna['hidden']) ? $columna['hidden'] : false;
            $format = is_array($columna) && isset($columna['format']) ? $columna['format'] : null;

            return [
                'key' => $key,
                'label' => $label,
                'sortBy' => $sortBy,
                'hidden' => $isHidden,
                'format' => $format,
            ];
        });
    }

    public function sortBy($field)
    {
        // dd($field);
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Método para manejar el clic en una fila
    public function selectItem($id)
    {
        if ($this->frmFixeModal === "Fixe") {
            $this->emit('edit', $id);
        } else {
            // $this->emit('openModal', $id);
        }
    }

    // Método para cambiar la cantidad de registros por página
    public function changePerPage($value)
    {
        $this->perPage = $value;
        $this->resetPage(1); // Reseteamos la página para evitar problemas de paginación
        $this->emit('changePerPage', $value);
    }

    public function confirmDelete($id)
    {
        $this->emitUp('confirmDelete', $id);
    }

    public function newEdit($id)
    {
        $this->emitUp('openModal', $id);
    }

    public function activeApplied()
    {
        $this->emitUp('activeApplied');
    }
}
