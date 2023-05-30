<?php

namespace App\Http\Livewire\Backend\Users;

use Livewire\Component;

class LiveUsermodal extends Component
{
    public $showModal = false;

    public  $encabezado, $contenido, $piepagina;


    public function render()
    {
        return view('livewire.backend.users.live-usermodal')->layout('layouts.app', ['contenido' => $this->contenido,]);

        // return view('livewire.show-posts')
        // ->layoutData(['title' => 'Show Posts'])
    }

    public function mount(array $slot)
    {
        $this->encabezado = $slot['encabezado'];
        $this->contenido = $slot['contenido'];
        $this->piepagina = $slot['piepagina'];
    }
    public function showModal()
    {
        $this->showModal = !$this->showModal;
    }
}
