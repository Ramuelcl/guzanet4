<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

class LiveInput extends Component
{
    public $type, $idName, $value, $label, $placeholder, $icono = [], $ico = null, $lenIco = 0;

    // public function render()
    // {
    //     return view('livewire.forms.live-input');
    // }

    public function mount(string $idName, string  $type = 'text', string $label = '', string $placeholder = '', $icono = [])
    {
        $this->idName = $idName;
        $this->type = $type;
        $this->label = $label;
        $this->placeholder = $placeholder;
        // $this->icono = $icono;
        $this->lenIco = sizeof($icono);
        $this->ico = is_array($icono);
        if ($this->lenIco == 1) {
            $this->icono[0] = $this->fnc_Icono($icono[0]);
            $this->icono[1] = $this->fnc_Icono($icono[0]);
        } elseif ($this->lenIco == 2) {
            $this->icono[0] = $this->fnc_Icono($icono[0]);
            $this->icono[1] = $this->fnc_Icono($icono[1]);
        }
    }

    public function wc_cambiaEstado()
    {
        // dd(['type' => $this->type]);
        if ($this->type == 'password') {
            $this->type = 'text';
        } else {
            $this->type = 'password';
        }
        // $this->render();
    }
    public function fnc_Icono(string $nombre): string
    {
        switch ($nombre) {
            case 'at-symbol':
                $icono = "M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25";
                break;

            case 'mail':
                $icono = "M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75";
                break;

            case 'eye':
                $icono = "M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z";
                break;

            case 'eyeSlash':
                $icono = "M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88";
                break;

            case 'envelope':
                $icono = "M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75";
                break;

            case 'envelope-open':
                $icono = "M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z";
                break;

            case 'magnifying-glass':
                $icono = "M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z";
                break;

            default:
                $icono = "";
                break;
        }
        return $icono;
    }
}
