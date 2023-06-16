<?php

namespace App\Http\Controllers;

use App\Imports\TraspasoBancaImport;
use App\Models\banca\TraspasoBanca;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function showImportForm()
    {
        return view('banca.import');
    }

    public function import(Request $request)
    {
        $separadorCampos = $request->input('separador_campos');
        $caracterString = $request->input('caracter_string');
        $saltosLinea = $request->input('saltos_linea');
        $lineaDatos = $request->input('linea_datos');

        $archivo = $request->file('archivo');

        $extension = $archivo->getClientOriginalExtension();
        $nombreOriginal = $archivo->getClientOriginalName();

        if ($this->checkFileImported($nombreOriginal)) {
            // El archivo ya ha sido importado, realiza alguna acción (por ejemplo, mostrar un mensaje de error)
            return redirect()->back()->with('error', 'El archivo ya ha sido importado');
        } else {
            // Procede con la importación del archivo

            try {
                // Importar el archivo
                $import = new TraspasoBancaImport($separadorCampos, $caracterString, $saltosLinea, $lineaDatos, $nombreOriginal, $extension);
                Excel::import($import, $archivo);

                return redirect()->back()->with('success', 'El archivo se ha importado correctamente.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Ha ocurrido un error al importar el archivo: ' . $e->getMessage());
            }
        }
    }

    public function checkFileImported($nombreArchivo)
    {
        try {
            $count = TraspasoBanca::where('NomArchTras', $nombreArchivo)->count();
        } catch (\Throwable $th) {
            $count = 0;
        }

        return $count > 0;
    }
}
