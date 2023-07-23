<?php

namespace App\Http\Livewire\Admin;

use App\Models\backend\Entidad;
use Livewire\Component;

class LiveEntidades extends Component
{
    public $entidades;

    public function mount()
    {
        $this->entidades = Entidad::all();
    }

    public function render()
    {
        return view('livewire.admin.live-entidades');
    }
}
