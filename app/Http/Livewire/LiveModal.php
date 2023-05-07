<?php

namespace App\Http\Livewire;

use App\Http\Requests\RolePermissionRequest;
use Livewire\Component;

class LiveModal extends Component
{
    public $muestraModal;
    static $contModal = 0;
    public $modalAction;
    public $modalTitle;
    public $modalButton;

    // campos
    public $item;
    // escuchas
    protected $listeners = [
        'fncCargaModal',
    ];

    public function __construct()
    {
        // dd($muestraModal, $modalAction, $title, $modalButton);
        // $muestraModal = $this::$contModal == 0 ? false : true;
    }

    public function render()
    {
        return view('livewire.live-modal');
    }
    public function fncCargaModal($item, string  $modalTitle = 'Título del Modal.', string  $modalButton = 'Botón2', array  $modalAction = [])
    {
        if ($item)
            $this->item = $item;
        else
            $this->item = ['name' => ''];

        $this->modalAction = $modalAction;
        $this->modalButton = $modalButton;
        $this->modalTitle = $modalTitle;

        // dd($item, $title);

        $this->fncToggleModal();
    }
    public function fncToggleModal()
    {
        $this->muestraModal = $this->muestraModal ? false : true;
    }

    public function wc_action($item)
    {
        // dd($this->modalAction, $item);
        $this->emit($this->modalAction['call'], $item);
        $this->fncToggleModal();
    }

    public function ValideData()
    {
        // dd("llego a ValideData");
        //
        $request = new RolePermissionRequest();
        $values = $this->validate($request->rules('roles'), $request->messages());
        // dd("Valido", $values);
        $this->wc_action($values);
    }
    public function updated($field)
    {
        // dd($field);
        $Request = new RolePermissionRequest();
        $this->validateOnly($field, $Request->rules('roles'), $Request->messages());
    }
}
