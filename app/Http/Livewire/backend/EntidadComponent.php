<?php
// app/Http/Livewire/Backend/EntidadComponent.php

namespace App\Http\Livewire\Backend;

use App\Models\backend\Entidad;
use Livewire\{Component, WithPagination};

class EntidadComponent extends Component
{
    use WithPagination;

    public $razonSocial;
    public $nombres;
    public $apellidos;
    public $eMail;
    public $tipo = 1;
    public $is_active = 1;

    // Reglas de validación para los campos
    protected $rules = [
        'razonSocial' => 'max:128',
        'nombres' => 'required|string|max:80',
        'apellidos' => 'max:80',
        'eMail' => 'required|email|unique:entidades,eMail|max:255', // Aquí usamos la regla unique para evitar duplicados en la base de datos
        'tipo' => '', // Supongamos que el campo tipo solo puede ser 1, 2 o 3
    ];

    public $selectedItem; // Variable para almacenar el registro seleccionado
    public $editing = false; // Variable para indicar si se está editando o creando un registro nuevo
    public $confirmingDelete = false;
    public $deleteId = null;

    public $frmFixeModal = 'Fixe'; // Variable para determinar el sistema de formulario fijo=false/modal=true
    public $isModalOpen = false; // Variable para controlar la apertura y cierre de la ventana modal

    public $perPage = 5;
    public $search = '';
    public $isActiveOnly = false;
    public $sortBy = 'id'; // Columna por defecto para el ordenamiento
    public $sortDirection = 'asc'; // Sentido del orden por defecto

    protected $listeners = ['changePerPage', 'sortBy', 'edit', 'openModal', 'confirmDelete', 'searchApplied', 'activeApplied'];

    public function render()
    {
        $entidades = $this->getData();
        // dump(['entidades' => $entidades]);
        return view('livewire.backend.entidad-component', [
            'entidades' => $entidades,
        ]);
    }

    // Método para cambiar el valor de $perPage
    public function changePerPage($value)
    {
        // dd($value);
        $this->perPage = $value;
        $this->render(); // Volver a obtener los datos con la nueva paginación
    }

    public function sortBy($params)
    {
        $this->sortBy = $params[0];
        $this->sortDirection = $params[1];
    }

    public function getData()
    {
        // Consulta base para obtener los registros de la entidad
        $query = Entidad::query();

        // Aplicar filtro de búsqueda si hay texto en el campo de búsqueda
        if (!empty($this->search)) {
            $query->where(function ($q) {
                //function (Builder $q)
                // Asegurar que $q sea una instancia de Builder
                $q->where('razonSocial', 'like', '%' . $this->search . '%')
                    ->orWhere('nombres', 'like', '%' . $this->search . '%')
                    ->orWhere('apellidos', 'like', '%' . $this->search . '%')
                    ->orWhere('eMail', 'like', '%' . $this->search . '%');
            });
        }

        // Aplicar filtro de is_active para ver solo los registros activos utilizando el scope
        // solo si $this->isActiveOnly es true
        if ($this->isActiveOnly) {
            $query->isActive();
        }

        // Ordenar por columna y dirección en caso de haber aplicado un ordenamiento
        if (!empty($this->sortBy) && !empty($this->sortDirection)) {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        // Retorna la consulta para que se puedan encadenar otros métodos
        // Devolver la consulta paginada
        return $query->paginate($this->perPage);
    }
}
