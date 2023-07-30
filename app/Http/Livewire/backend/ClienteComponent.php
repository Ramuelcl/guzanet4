<?php
// app/Http/Livewire/Backend/ClienteComponent.php

namespace App\Http\Livewire\Backend;

use App\Models\backend\Entidad as Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class ClienteComponent extends Component
{
    use WithPagination;
    // variables del registro
    public $razonSocial;
    public $nombres;
    public $apellidos;
    public $email;
    public $is_active;

    // controles de la pantalla
    public $frmFixeModal = 'Fixe';
    public $selectedItem; // Variable para almacenar el registro seleccionado
    // depuracion
    public static $contador = 0;

    public function render()
    {
        $clientes = Cliente::all();
        // $clientes = Cliente::paginate(5);
        self::$contador++;
        // dump(self::$contador);
        return view('livewire.backend.cliente-component', [
            'clientes' => $clientes,
        ]);
    }

    // Método para manejar el clic en un item de la tabla
    public function selectItem($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $this->selectedItem = $id;
            $this->razonSocial = $cliente->razonSocial;
            $this->nombres = $cliente->nombres;
            $this->apellidos = $cliente->apellidos;
            $this->email = $cliente->email;
            $this->is_active = $cliente->is_active;
        }
    }
}
