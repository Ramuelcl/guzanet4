<?php
// app/Http/Livewire/Backend/EntidadComponent.php

namespace App\Http\Livewire\Backend;

use App\Models\backend\Entidad;
use Livewire\Component;

class EntidadComponent extends Component
{
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
    public $perPage = 5; // Número de registros por página
    public $search = '';
    public $isActiveOnly = false;
    public $sortBy = 'id'; // Columna por defecto para el ordenamiento
    public $sortDirection = 'asc'; // Sentido del orden por defecto

    protected $listeners = ['edit', 'openModal', 'sortBy', 'changePerPage', 'confirmDelete', 'searchApplied', 'activeApplied'];

    public function render()
    {
        $entidades = $this->getData();
        // dump(['entidades' => $entidades]);
        return view('livewire.backend.entidad-component', [
            'entidades' => $entidades,
        ]);
    }

    public function store()
    {
        // Validamos los datos según las reglas definidas
        $this->validate();

        if ($this->editing) {
            // Estamos editando un registro existente
            if ($this->selectedItem) {
                $this->selectedItem->update([
                    'razonSocial' => $this->razonSocial,
                    'nombres' => $this->nombres,
                    'apellidos' => $this->apellidos,
                    'eMail' => $this->eMail,
                    'is_active' => $this->is_active,
                    // Otros campos si los hubiera...
                ]);
            }
            $this->editing = false; // Resetear la propiedad $editing después de editar
        } else {
            // Estamos creando un nuevo registro
            Entidad::create([
                'razonSocial' => $this->razonSocial,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'eMail' => $this->eMail,
                'is_active' => $this->is_active,
                'tipo' => $this->tipo,
            ]);
        }

        $this->resetInputs();
        $this->emit('refreshList');
    }

    public function edit($id)
    {
        // dd($id);
        // Método para editar una entidad
        $entidad = Entidad::find($id);
        if ($entidad) {
            // dd($entidad);
            $this->selectedItem = $entidad;
            $this->razonSocial = $entidad->razonSocial;
            $this->nombres = $entidad->nombres;
            $this->apellidos = $entidad->apellidos;
            $this->eMail = $entidad->eMail;
            $this->is_active = $entidad->is_active;

            $this->editing = true; // Indicar que estamos editando un registro
        } else {
            dump('registro no encontrado');
        }
    }

    public function update()
    {
        if ($this->selectedItem) {
            $this->selectedItem->update([
                'razonSocial' => $this->razonSocial,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'eMail' => $this->eMail,
                'is_active' => $this->is_active,
            ]);
        }
        $this->closeModal(); // Agregamos esta línea para cerrar el modal
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }

    public function delete()
    {
        $entidad = Entidad::find($this->deleteId);
        if ($entidad) {
            $entidad->delete();
            // Entidad::destroy($id);
        }
        $this->confirmingDelete = false;
        $this->deleteId = null;
        $this->resetInputs();
        $this->emit('refreshList');
    }

    private function resetInputs()
    {
        $this->razonSocial = null;
        $this->nombres = null;
        $this->apellidos = null;
        $this->eMail = null;
        $this->tipo = 1;

        $this->editing = false;
    }

    // Método para abrir el modal y cargar los datos del registro seleccionado en el formulario
    public function openModal($id)
    {
        // dd("openModal");
        if ($id === 0) {
            // crear
            $this->resetInputs();
        } else {
            //editar
            $this->edit($id);
        }

        $this->isModalOpen = true;
    }
    // Método para cerrar el modal y limpiar los campos del formulario
    public function closeModal($modal)
    {
        $this->selectedItem = null;
        if ($this->editing) {
            $this->resetInputs();
        }
        $this->$modal = false;
    }

    public function searchApplied($search)
    {
        // Aplicar los filtros recibidos del evento
        $this->search = $search;

        // Reiniciar la paginación a la primera página al aplicar nuevos filtros
        // $this->resetPage();
    }

    public function activeApplied()
    {
        // Aplicar los filtros recibidos del evento
        $this->isActiveOnly = !$this->isActiveOnly;

        // Reiniciar la paginación a la primera página al aplicar nuevos filtros
        // $this->resetPage();
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
        return $query;
    }
}
