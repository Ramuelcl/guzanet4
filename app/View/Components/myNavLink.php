<?php
// <!-- app/View/Components/NavLink.php -->

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class NavLink extends Component
{
    public $href;
    public $active;

    public function __construct($href, $active = false)
    {
        $this->href = $href;
        $this->active = $active;
    }

    public function render()
    {
        return view('components.nav-link');
    }

    public function isActive()
    {
        return $this->active || request()->url() === url($this->href);
    }
}
