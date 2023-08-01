<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class SearchComponent extends Component
{
    public $search = '';

    protected $listeners = ['applySearch'];

    public function applySearch()
    {
        // dd($this->search);
        // Pasamos los filtros directamente al componente padre (EntidadComponent) usando el método "emit"
        $this->emit('searchApplied', $this->search);
    }

    public function render()
    {
        return view('livewire.components.search-component');
    }
}
