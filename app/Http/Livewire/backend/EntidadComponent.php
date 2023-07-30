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

    public $selectedItem; // Variable para almacenar el registro seleccionado
    public $editing = false; // Variable para indicar si se está editando o creando un registro nuevo
    public $confirmingDelete = false;
    public $deleteId = null;

    public $frmFixeModal = 'Fixe'; // Variable para determinar el sistema de formulario fijo=false/modal=true
    public $isModalOpen = false; // Variable para controlar la apertura y cierre de la ventana modal
    public $perPage = 5; // Número de registros por página

    protected $listeners = ['edit', 'OpenModal', 'changePerPage', 'confirmDelete'];

    public function render()
    {
        $entidades = Entidad::paginate($this->perPage);

        return view('livewire.backend.entidad-component', [
            'entidades' => $entidades,
        ]);
    }

    public function store()
    {
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
        $this->emit("refreshList");
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

        } else
            dump('registro no encontrado');
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
        $this->isModalOpen = false; // Agregamos esta línea para cerrar el modal

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

    // Método para cerrar el formulario en la misma lista y limpiar los campos
    public function closeFormInList()
    {
        $this->selectedItem = null;
        $this->resetInputs();
    }

    // Método para abrir el modal y cargar los datos del registro seleccionado en el formulario
    public function openModal($id)
    {
        dd("openModal");
        $this->edit($id);

        $this->isModalOpen = true;
    }

    // Método para cerrar el modal y limpiar los campos del formulario
    public function closeModal()
    {
        $this->selectedItem = null;
        $this->resetInputs();
        $this->isModalOpen = false;
    }

    // Método para cambiar la cantidad de registros por página
    public function changePerPage($value)
    {
        $this->perPage = $value;
        $this->resetPage(); // Reseteamos la página para evitar problemas de paginación
    }
}
