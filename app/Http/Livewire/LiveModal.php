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
    public $modelo, $modo;

    // campos
    public $item;
    public $name, $checkit;
    // escuchas
    protected $listeners = [
        'fncCargaModal',
    ];

    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('livewire.live-modal');
    }

    public function fncCargaModal($item, string  $modalTitle = 'Título del Modal.', string  $modalButton = 'Botón Modal', array  $modalAction = [])
    {
        if (isset($item->id))
            $this->item = [
                'name' => $item->name,
                'checkit' => []
            ];
        else
            $this->item = [
                'name' => '',
                'checkit' => []
            ];

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
