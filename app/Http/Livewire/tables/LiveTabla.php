<?php

namespace App\Http\Livewire\Tables;

use Livewire\Component;
use Livewire\WithPagination;

class LiveTabla extends Component
{
    use WithPagination;

    public $data;
    public $encabezado;
    public $titulos;
    public $campos;
    public $lineasMostradas = 5;

    public function mostrarMasLineas()
    {
        $this->lineasMostradas += 5;
    }

    public function mount($data, $encabezado, $titulos, $campos, $paginate = 5)
    {
        $this->data = $data;

        $this->encabezado = $encabezado;
        $this->titulos = $titulos;
        $this->campos = $campos;
        $this->lineasMostradas = $paginate;
        // $this->data->paginate($this->lineasMostradas);
    }

    public function render()
    {
        // $paginatedData = $this->data->paginate($this->lineasMostradas);

        return view('livewire.tables.live-tabla', [
            'data' => $this->data
        ]);
    }
}
