<?php

namespace App\Http\Controllers;

use App\Imports\TraspasoBancaImport;
use App\Models\banca\TraspasoBanca;
use App\Models\banca\MovimientoBanca;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportExportController extends Controller
{
    public $mensajes = [];

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
            'MontantEUROS',
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

        $data = TraspasoBanca::all();

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
                $mensajes['error'] = "Archivo ya traspasado: $nombreOriginal";
                session()->put('error', $mensajes);
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
                    $mensajes['success'] = "El archivo ($nombreOriginal) se ha importado.";
                    session()->put('success', $mensajes);
                } catch (\Exception $e) {
                    // dd($archivo, $e->getMessage());
                    $mensajes['error'] = 'Ha ocurrido un error al importar el archivo: ' . $e->getMessage();
                    session()->put('error', $mensajes);
                }
            }
        }
        // Session::flash('session', $mensajes);
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

    public function pasar()
    {
        // Obtener los registros sin idArchMov de la tabla traspaso_bancas
        try {
            $registros = TraspasoBanca::whereNull('idArchMov')->get();

            foreach ($registros as $registro) {
                // Crear un nuevo registro en la tabla movimiento_bancas
                $movimiento = new MovimientoBanca();

                try {
                    $fechaFormateada = $this->castearDato($registro->Date, 'date2');
                    $montoFormateado = $this->castearDato($registro->MontantEUROS, 'float');
                    dd(['fecha' => $fechaFormateada, 'fecha' => $montoFormateado]);
                    $movimiento->dateMouvement = $fechaFormateada;
                    $movimiento->libelle = $registro->Libelle;
                    $movimiento->montant = $montoFormateado;
                    $movimiento->estado = 1; // Traspasada
                    //
                    $movimiento->save();

                    // Obtener el id del movimiento guardado
                    $idMovimiento = $movimiento->id;
                    dd($idMovimiento);
                    // Actualizar el campo idArchMov en la tabla traspaso_bancas
                    $registro->idArchMov = $idMovimiento;
                    $registro->save();
                } catch (\Throwable $e) {
                    // Manejar el error
                    // Puedes registrar el error, mostrar un mensaje o realizar alguna otra acción según tus necesidades
                    // Por ejemplo, puedes usar Log::error($e->getMessage()) para registrar el error en los logs
                    Log::error($e->getMessage());
                }
            }
        } catch (\Throwable $e) {
            // Manejar el error
            // Puedes registrar el error, mostrar un mensaje o realizar alguna otra acción según tus necesidades
            // Por ejemplo, puedes usar Log::error($e->getMessage()) para registrar el error en los logs
            Log::error($e->getMessage());
        }
    }

    protected function castearDato($valor, $forzarTipo)
    {
        $valor2 = null;
        switch ($forzarTipo) {
            case 'alpha':
                $valor2 = ctype_alpha($valor) ? $valor : null;
            case 'digit':
                $valor2 = ctype_digit($valor) ? $valor : null;
            case 'float':
                $valor2 = $this->convertirStringANumerico($valor);
                // dd($valor2);
                $valor2 = is_numeric($valor2) ? floatval($valor2) : null;
            case 'bool':
                $valor2 = filter_var($valor, FILTER_VALIDATE_BOOLEAN) ? '1' : null;
            case 'date1':
                $valor2 = $this->parsearFecha($valor);
            case 'date2':
                $valor2 = $this->parsearFecha2($valor);
            case 'date3':
                $valor2 = $this->parsearFecha2($valor);
            case 'datetime':
                $valor2 = $this->parsearFechaHora($valor);
                // default:
                //     return $valor;
        }
        // dump(['valor' => $valor, 'tipo' => $forzarTipo, 'resultado' => $valor2]);
        return $valor2;
    }
    function convertirStringANumerico($valor)
    {
        // Obtener el separador decimal actual
        $separadorDecimalActual = localeconv()['decimal_point'];

        // Reemplazar el separador decimal actual por un punto decimal
        $valorConPuntoDecimal = str_replace($separadorDecimalActual, '.', $valor);

        // Convertir el string en un valor numérico
        $valorNumerico = floatval($valorConPuntoDecimal);

        return $valorNumerico;
    }

    private function parsearFecha($valor)
    {
        if ($valor)
            try {
                $fecha = DateTime::createFromFormat('Y-m-d', $valor);
                return $fecha->format('Y-m-d');
            } catch (Exception $e) {
                // Error al parsear la fecha
                return null;
            }
    }


    protected function parsearFechaHora($valor)
    {
        try {
            return new DateTime($valor);
        } catch (Exception $e) {
            // Error al parsear la fecha
            return null;
        }
    }

    public function parsearFecha2($valor, $viene = "dd/mm/YY")
    {
        try {
            switch ($viene) {
                case "dd/mm/YY":
                    // Intentar formatear la fecha en el formato d/m/Y (dd/mm/YY)
                    $fechaCarbon = Carbon::createFromFormat('d/m/Y', $valor);
                    break;
                case "YY/mm/dd":
                    // Intentar formatear la fecha en el formato Y/m/d (YY/mm/dd)
                    $fechaCarbon = Carbon::createFromFormat('Y/m/d', $valor);
                    break;
                default:
                    throw new \Exception('Formato de fecha inválido');
                    break;
            }
        } catch (\Throwable $e) {
            dd($e);
            // Si ocurre un error, devolver un valor predeterminado o indicador de fecha inválida
            return null; // Valor predeterminado o indicador de fecha inválida
        }
        return $fechaCarbon; //->format('Ymd');
    }
    public function parsearFecha3($valor, $viene = "dd/mm/YY")
    {
        $fechaObjeto = DateTime::createFromFormat($viene, $valor);
        $fechaConvertida = $fechaObjeto->format('Ymd');
        return $fechaConvertida;
    }
}
