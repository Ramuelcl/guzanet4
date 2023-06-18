<?php

namespace App\Imports;

use App\Models\banca\TraspasoBanca;
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

    public function __construct($nombreArchivo, $cnfTraspaso, $camposTabla, $camposArchivo)
    {

        // Crear una instancia de clsFileReader y configurar opciones personalizadas
        $this->fileReader = new clsFileReader($nombreArchivo);

        $this->fileReader->setConfig($cnfTraspaso);

        $this->nombreOriginal = $nombreArchivo;
        $this->camposTabla = $camposTabla;
        $this->camposArchivo = $camposArchivo;
        // dd(['fileReader' => $this->fileReader]);
    }

    public function import($file)
    {
        $this->createTablaTraspasos();
        $asArray = true;
        // Leer el archivo línea por línea
        $this->fileReader->open($file);

        // dd('llegó import');
        $lineas = 0;
        while (($line = $this->fileReader->readLines($asArray)) !== false) {
            // Obtener datos de la línea actual
            // dump([$line, 'lineas' => $lineas, 'encabezado empieza=' => $this->fileReader->letLineaEncabezado()]);
            $lineas++;
            if ($lineas <= $this->fileReader->letLineaEncabezado()) {
                continue;
            }

            // dd("leyo lineas");

            // recupera la linea particionada en un arreglo
            $row = $this->fileReader->parseLine($line, $this->camposArchivo); //para ser asociativos, asigno nombres
            // dump(["parseado" => $row]);

            // Asociar campos de la tabla con las columnas del archivo
            $rowFormat = [];

            foreach ($this->camposTabla as $columnaTabla => $campoTabla) {
                // dump(is_numeric($columnaTabla), $campoTabla);

                if (!is_numeric($columnaTabla)) {
                    $tipo = $campoTabla;
                    $ind = $columnaTabla;
                } else {
                    $tipo = null;
                    $ind = $campoTabla;
                }

                if (array_key_exists($ind, $row)) {
                    $rowFormat[$ind] = $this->fncTransfiereDato($row[$ind], $tipo);
                } else {
                    $rowFormat[$ind] = 0;
                    // La columna no existe en el archivo, puedes manejar el caso aquí
                    // por ejemplo, asignar un valor predeterminado o lanzar una excepción
                }

                // dd(['indice' => $ind, 'tabla format' => $rowFormat[$ind],  'tipo' => $tipo]);
            }

            // dd(["pasado con valores" => $rowFormat]);

            // Crear una nueva instancia del modelo y guardar en la base de datos
            $modelo = new TraspasoBanca($rowFormat);
            $modelo->NomArchTras = $this->nombreOriginal;
            $modelo->save();
            // dump("crea registro");
        }

        $this->fileReader->close();
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

    // protected function castearDato($valor, $forzarTipo)
    // {
    //     switch ($forzarTipo) {
    //         case 'alpha':
    //             return ctype_alpha($valor) ? $valor : null;
    //         case 'digit':
    //             return ctype_digit($valor) ? $valor : null;
    //         case 'float':
    //             return is_numeric($valor) ? floatval($valor) : null;
    //         case 'bool':
    //             return filter_var($valor, FILTER_VALIDATE_BOOLEAN) ? '1' : null;
    //         case 'date':
    //             return $this->parsearFecha($valor);
    //         case 'datetime':
    //             return $this->parsearFechaHora($valor);
    //         default:
    //             return $valor;
    //     }
    // }

    private function parsearFecha($valor)
    {
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
                echo "La tabla traspaso_bancas ha sido vaciada.<br>";
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
