<?php

namespace App\Imports;

use App\Models\banca\Traspaso;
use App\Imports\clsFileReader;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TraspasoBancaImport extends clsFileReader
{
    public $fileReader;

    public $nombreOriginal;

    public $camposTabla;
    public $camposArchivo;
    public $cnfTraspaso;

    public function __construct($nombreArchivo, $cnfTraspaso, $camposTabla, $camposArchivo = null)
    {

        // Crear una instancia de clsFileReader y configurar opciones personalizadas
        $this->fileReader = new clsFileReader($nombreArchivo);
        // $this->fileReader->determinarOpcionesPorDefecto();
        $this->fileReader->setConfig($cnfTraspaso);

        $this->nombreOriginal = $nombreArchivo;
        $this->camposTabla = $camposTabla;
        $this->camposArchivo = $camposArchivo;
        // dd(['fileReader' => $this->fileReader]);
    }

    public function import($file)
    {
        $row = [];
        $this->createTablaTraspasos();
        $asArray = true;
        // Leer el archivo línea por línea
        $this->fileReader->open($file);

        // dd('llegó import');
        $lineas = 0;
        while (($line = $this->fileReader->readLines()) !== false) {
            $lineas++;
            // Obtener datos de la línea actual
            // dump([$line, 'lineas' => $lineas, 'encabezado empieza=' => $this->fileReader->letLineaEncabezado()]);
            if ($lineas == $this->fileReader->letLineaEncabezado() && $this->camposArchivo === null) {
                $this->fileReader->determinarOpcionesPorDefecto();
                $this->camposArchivo = $this->fileReader->parseLine($line);
                dump(['camposArchivo' => $this->camposArchivo]);
                continue;
            }
            if ($lineas < $this->fileReader->letLineaEncabezado()) {
                continue;
            }

            // dump("leyó linea: " . $line);
            // recupera la linea particionada en un arreglo
            try {
                $row = $this->fileReader->parseLine($line, $this->camposArchivo); //para ser asociativos, asigno nombres
            } catch (\Throwable $th) {
                dd("que pasa");
                throw $th;
            }
            // dd(["separó linea: " => $row]);

            if (sizeof($row) < sizeof($this->camposArchivo)) {
                // debo reconocer cual es el que falta
                $row['MontantFRANCS'] = 0;
            }

            // dump($line);

            // sleep(5);

            // Crear una nueva instancia del modelo y guardar en la base de datos
            dump([0 => $row[$this->camposArchivo[0]], 1 => $row[$this->camposArchivo[1]], 2 => $row[$this->camposArchivo[2]], 3 => $row[$this->camposArchivo[3]],]);
            $libelle = $this->fncConvertirCadenaBytes($row[$this->camposArchivo[1]]);
            $modelo = new Traspaso();
            $modelo->Date = $row[$this->camposArchivo[0]];
            $modelo->Libelle = $libelle;
            $modelo->MontantEUROS = $row[$this->camposArchivo[2]];
            $modelo->MontantFRANCS = $row[$this->camposArchivo[3]];
            $modelo->NomArchTras = $this->nombreOriginal;
            // $modelo->Date_Libelle_montantEUROS_montantFRANCS =
            //     $row[$this->camposArchivo[0]]             .
            //     $libelle .
            //     $row[$this->camposArchivo[2]] .
            //     $row[$this->camposArchivo[3]];
            $modelo->save();
            // dump("crea registro");
        }

        $this->fileReader->close();
    }

    //     public function store(Request $request)
    // {
    //     // dump($request);
    //     $request->validate([
    //         'nombre' => 'required|unique:colors',
    //         'hexa' => 'required|unique:colors',
    //     ]);
    //     $request->merge([
    //         'slug' => Str::slug($request->nombre),
    //     ]);
    //     $color = Color::create($request->all());
    //     return redirect()
    //         ->route('backend.colores.edit', $color)
    //         ->with('info', 'Registro creado');
    // }

    function fncConvertirCadenaBytes($string, $default = 'UTF-8')
    {
        $encodings = array('UTF-8', 'ISO-8859-1', 'Windows-1251');
        $validEncoding = false;
        foreach ($encodings as $encoding) {
            if (mb_check_encoding($string, $encoding)) {
                $validEncoding = true;
                echo "La cadena está codificada en $encoding";
                $string = mb_convert_encoding($string, $default, $encoding);
                break;
            }
        }
        if (!$validEncoding) {
            echo "La cadena no está codificada en ninguna de las codificaciones admitidas";
        }
        return $string;
    }

    private function fncTransfiereDato($valor, $tipoDato = 0)
    {
        // dump(['fncTransfiereDato' => $valor, $tipoDato]);
        if ($tipoDato === 'integer') {
            $value            = (int) $valor;
            // dump($value);
            return $value;
        } elseif ($tipoDato === 'date') {
            $value          =  date('Y/d/m', strtotime($valor));
            // dump($value);
            return $value;
        } elseif (strpos($tipoDato, 'decimal') !== false) {
            $precision = explode(',', $tipoDato)[1] ?? 2;
            $value          = number_format((float) $valor, $precision, '.', '');
            // dump($value);
            return $value;
        } else {
            $value          = (string) $valor;
            // dump($value);
            return $value;
        }
    }

    public function createTablaTraspasos()
    {
        try {
            // Crear la tabla traspaso_bancas
            if (!Schema::hasTable('traspaso_bancas')) {
                DB::statement('
            CREATE TABLE traspaso_bancas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                Date VARCHAR(10),
                Libelle TEXT,
                MontantEUROS VARCHAR(15),
                MontantFRANCS VARCHAR(15),
                NomArchTras VARCHAR(100),
                IdArchMov BIGINT(10)
                )
            ');
                echo "La tabla traspaso_bancas ha sido creada exitosamente.<br>";
            }

            // Vaciar la tabla si tiene datos
            $count = DB::table('traspaso_bancas')->count();
            if ($count > 0) {
                //     DB::table('traspaso_bancas')->truncate();
                // echo "La tabla traspaso_bancas ha sido vaciada.<br>";
            }
            //
            if ($count == 0) {
                DB::statement('ALTER TABLE traspaso_bancas AUTO_INCREMENT = 1;');
                echo "La tabla traspaso_bancas tiene el incrementador en 1.<br>";
            }
        } catch (\Exception $e) {
            echo "Error al crear, vaciar o poner a 1 el AUTO_INCREMENT de la tabla traspaso_bancas: " . $e->getMessage() . "<br>";
        }
    }
}
