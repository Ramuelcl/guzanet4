<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PrincipalController extends Controller
{
    public function home()
    {
        return view('components.principal.home');
    }

    public function acercade()
    {
        return view('components.principal.acercade');
    }

    public function contacto()
    {
        return view('components.principal.contacto');
    }

    public function porDefinir()
    {
        return view('components.principal.porDefinir');
    }

    public function testInput()
    {
        return view('testInput');
    }
}
