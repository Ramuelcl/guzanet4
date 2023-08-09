<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class layout01 extends Component
{
    public $titulo;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Create a new component instance.
     */
    public function mount($titulo = null)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.layout01');
    }
}
