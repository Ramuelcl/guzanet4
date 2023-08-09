<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.layouts.layout01');
    }
}
// programa principal para cargar las vistas, no logro encontrar quién lo carga primero
