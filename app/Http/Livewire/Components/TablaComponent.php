<?php
// app/Http/Livewire/Components/TablaComponent.php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;

class TablaComponent extends Component
{
    use WithPagination;

    public $modelo; // Variable para almacenar el nombre del modelo a consultar
    public $columnas; // Variable para almacenar las columnas de la tabla
    public $sortBy = 'id'; // Columna por defecto para el ordenamiento
    public $sortDirection = 'asc'; // Sentido del orden por defecto
    public $selectedItem = null; // Variable para almacenar el registro seleccionado
    public $frmFixeModal = null; // Agregamos la propiedad $frmFixeModal
    public $perPage = 5; // Número de registros por página

    protected $listeners = ['changePerPage', 'refreshList' => 'render'];

    public function mount($modelo, $columnas = [], $perPage)
    {
        $this->modelo = $modelo;
        $this->columnas = $columnas;
        $this->perPage = $perPage;
    }

    public function render()
    {
        // Verificamos si el modelo es válido y si tiene las columnas para la tabla
        if (class_exists($this->modelo) && !empty($this->columnas)) {
            $modelo = $this->modelo;
            $columnas = $this->columnas;

            // Consultamos los datos del modelo paginados y ordenados
            $data = $modelo::orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);

            return view('livewire.components.tabla-component', compact('data', 'columnas'));
        }

        // Si el modelo o las columnas no son válidas, retornamos una vista de error
        return view('livewire.components.tabla-component-error');
    }

    public function sortBy($column)
    {
        // dump($column);
        // Cambiamos la columna y sentido de ordenamiento
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    // Método para manejar el clic en una fila
    public function selectItem($id)
    {
        if ($this->frmFixeModal === "Fixe") {
            // Lógica para abrir el formulario en la misma lista
            // $this->selectedItem = $id;
            // $item = $this->modelo::find($id);
            $this->emit('edit', $id);
        } else {
            $this->emit('openModal', $id);
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
}
