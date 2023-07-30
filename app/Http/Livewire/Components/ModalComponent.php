<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ModalComponent extends Component
{
    public $isOpen = false; // Variable para controlar si el modal está abierto o cerrado

    protected $listeners = ['openModal', 'closeModal'];

    public function render()
    {
        return view('livewire.components.modal-component');
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
