<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View as View;
use Illuminate\Http\Request;
use Livewire\{
    Component,
    Livewire,
    ComponentsFinder
};
use App\Http\Controllers\Controller;

class LivewireController extends Controller
{
    public function __invoke(Request $request, string $component): View
    {
        $livewireFinder = app(ComponentsFinder::class);
        $componentClass = $livewireFinder->find($component);

        $title = $request->query('title');

        return view('live-entidades', compact('componentClass', 'title'));
    }

    public function Entidades(Request $request, string $component): View
    {
        $livewireFinder = app(ComponentsFinder::class);
        $componentClass = $livewireFinder->find($component);

        $title = $request->query('title');

        return view('livewire.admin.live-entidades', compact('componentClass', 'title'));
    }
}
