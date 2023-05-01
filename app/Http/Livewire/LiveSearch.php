<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveSearch extends Component
{
    public $search = '';
    public $fields = '';

    /** escuchas */
    protected $listeners = [
        'fncSearchClear',
        'fncSearchFields',
        // 'roleUpdating' => 'render',
    ];

    public function __construct()
    {
        //
    }

    public function render()
    {
        // if ($this->search)
        //     dd($this->search);

        return view('livewire.live-search', [$this->fields]);
    }

    public function updatedSearch()
    {
        $this->emitUp('search', $this->search);
    }

    public function fncSearchClear()
    {
        $this->reset(['search']);
        // $this->reset();
    }
    public function fncSearchFields($fields = [])
    {
        $fields = implode(", ", $fields);
        // dd($fields);

        $this->fields = $fields;
    }
}
