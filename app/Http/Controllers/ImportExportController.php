<?php

namespace App\Http\Controllers;

use App\Imports\TraspasoBancaImport;
use App\Models\banca\TraspasoBanca;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function showImportForm()
    {
        $titulos = [
            'id',
            'Date',
            'Libelle',
            'EURES',
            'FRANCS',
            'archivo traspaso',
            '# movimiento'
        ];

        $campos = [
            'id',
            'Date',
            'Libelle',
            'MontantEURES',
            'MontantFRANCS',
            'NomArchTras',
            'IdArchMov'
        ];
        $totalImportados = TraspasoBanca::count();
        $totalMovimientos = TraspasoBanca::whereNotNull('IdArchMov')->count();

        $registrosDuplicados = DB::table('traspaso_bancas')
            ->select(DB::raw("GROUP_CONCAT(CONCAT(Date, Libelle, MontantEUROS) SEPARATOR ', ') AS concat"))
            ->groupBy('Date', 'Libelle', 'MontantEUROS')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        $totalDuplicados = $registrosDuplicados->count();

        $data = TraspasoBanca::where('id', '>', '0')->get();

        return view('banca.import', ['data' => $data,  'titulos' => $titulos, 'campos' => $campos, 'totalImportados' => $totalImportados, 'totalMovimientos' => $totalMovimientos, 'totalDuplicados' => $totalDuplicados]);
    }

    public function import(Request $request)
    {
        // dd($request);

        // Validar el archivo enviado por el formulario
        $request->validate([
            'archivo' => 'required|array',
            'archivo.*' => 'mimes:csv,txt,tsv|max:2048',
        ]);

        $cnfTraspaso = [
            'separadorCampos' => $request->input('separador_campos'),
            'caracterString' => $request->input('caracter_string'),
            'finLinea' => $request->input('fin_linea'),
            'lineaEncabezados' => $request->input('linea_encabezados'),
        ];
        // Obtener los archivos enviados desde el formulario
        $archivos = $request->file('archivo');
        foreach ($archivos as $archivo) {

            // Obtener el nombre original del archivo
            $nombreOriginal = $archivo->getClientOriginalName();
            $extension = $archivo->getClientOriginalExtension();

            // dd($archivo, $nombreOriginal, $extension);

            // Verificar si el archivo ya ha sido importado
            if ($this->checkFileImported($nombreOriginal)) {
                // dump(['Archivo ya traspasado: ' => $archivo]);
                Session::flash('success', "Archivo ya traspasado: $archivo");
            } else {
                // Procede con la importación del archivo
                try {
                    // Determinar los campos y columnas correspondientes según la extensión del archivo
                    $camposTabla = [
                        'Date',
                        'Libelle',
                        'MontantEUROS',
                        'MontantFRANCS',
                        'NomArchTras'
                        // 'Date' => 'date',
                        // 'Libelle' => 'text',
                        // 'MontantEUROS' => 'decimal,2',
                        // 'MontantFRANCS' => 'decimal,2',
                        // 'NomArchTras'
                    ];

                    // Columnas del archivo
                    $camposArchivo = [
                        'Date',
                        'Libelle',
                        'MontantEUROS',
                        'MontantFRANCS',
                    ];
                    // dd(['camposTabla' => $camposTabla, 'camposArchivo' => $camposArchivo]);

                    // Crear una instancia de TraspasoBancaImport con los parámetros necesarios
                    $importador = new TraspasoBancaImport($nombreOriginal, $cnfTraspaso, $camposTabla, $camposArchivo);
                    // Importar los datos del archivo
                    // dd(['archivo' => $archivo]);
                    $importador->import($archivo);
                    // dd(['importador' => $importador]);

                    // Redireccionar o mostrar un mensaje de éxito
                    Session::flash('success', "El archivo ($nombreOriginal) se ha importado.");
                } catch (\Exception $e) {
                    // dd($archivo, $e->getMessage());
                    Session::flash('error', 'Ha ocurrido un error al importar el archivo: ' . $e->getMessage());
                }
            }
        }
        return redirect()->back();
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

    public function eliminarRegistrosDuplicados()
    {
        $registrosDuplicados = TraspasoBanca::selectRaw('MIN(id) as min_id, CONCAT(Date, Libelle, MontantEUROS, MontantFRANCS) as concatFields')
            ->groupBy('Date', 'Libelle', 'MontantEUROS', 'MontantFRANCS')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($registrosDuplicados as $registro) {
            TraspasoBanca::where('id', '<>', $registro->min_id)
                ->whereRaw('CONCAT(Date, Libelle, MontantEUROS, MontantFRANCS) = ?', [$registro->concatFields])
                ->delete();
        }

        return redirect()->back()->with('success', 'Registros duplicados eliminados correctamente');
    }
}
