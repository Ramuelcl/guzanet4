<?php

namespace App\Imports;

use App\Models\banca\TraspasoBanca;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Database\QueryException;

class ImportBanca implements ToModel, WithHeadingRow //, WithValidation
{
    protected $tipoArchivo;
    protected $saltosLinea;
    protected $separadorCampos;
    protected $caracterString;
    protected $lineaDatos;
    protected $nombreArchivoOriginal;
    protected static $currentRow = 0;
    public $sql;

    public function model(array $row)
    {
        if (self::$currentRow === 0) {
            $this->createTablaTraspasos(self::$currentRow);
        }
        self::$currentRow++; // Incrementar el contador de fila en cada iteración

        // Verificar si la línea actual está después de la línea de titulos
        $pos = strpos($row['numro_compte_5578733w020'], "Date;Libell");
        // dump([self::$currentRow, $row, $pos]);

        // cambio la linea donde están los datos, ya que encontré los títulos
        if ($pos === 0) $this->lineaDatos = self::$currentRow + 1;

        if (self::$currentRow >= $this->lineaDatos) {
            // Aplicar transformaciones a la fila solo si está después de la línea de datos
            $row[1] = explode($this->separadorCampos, $row['numro_compte_5578733w020']);
            $stringSinComillas = trim(str_replace('"', '', $row[1][1]));

            $row[1][0] = $row[1][0]; //$this->convertirFormatoFecha($row[1][0], 'Y/m/d', 'd/m/Y');
            $row[1][1] = $stringSinComillas;
            // // Aplicar saltos de línea
            // $row = $this->applyLineBreaks($row);

            // // // Aplicar separador de campos
            // $row = $this->applyFieldSeparator($row);

            // // // Aplicar caracteres especiales
            // $row = $this->applySpecialCharacters($row);

            // dd(['currentRow' => self::$currentRow, 'row' => $row, $this->getCsvSettings()]);

            // Crear el modelo MovimientoBanca con los datos
            dump([$row[1]]);
            // Hacer que PHP espere 5 segundos
            // sleep(15);
            $traspasoBanca = new TraspasoBanca([
                'Date' => $row[1][0],
                'Libelle' => $row[1][1],
                'Montant(EUROS)' => $row[1][2],
                // 'Montant(FRANCS)' => $row['monto'],
                // archivo ya incorporado
                'archivo' => $this->nombreArchivoOriginal,
            ]);

            // Guardar el modelo en la base de datos
            $traspasoBanca->save();

            // Retornar el modelo creado
            return $traspasoBanca;
        }

        // Si la línea actual es anterior a la línea de datos deseada, se ignora y se pasa a la siguiente fila
        return null;
    }
    function convertirFormatoFecha($fecha, $formatoSalida = 'd/m/Y', $formatoEntrada = 'm/d/Y')
    {
        $fechaObjeto = DateTime::createFromFormat($formatoEntrada, $fecha);

        if ($fechaObjeto === false) {
            // La fecha no pudo ser analizada correctamente
            return null;
        }

        $fechaFormateada = $fechaObjeto->format($formatoSalida);

        if ($formatoSalida === 'Y-m-d') {
            // Eliminar guiones si el formato de salida es 'Y-m-d'
            $fechaFormateada = str_replace('-', '', $fechaFormateada);
        }
        // dump($fechaFormateada);
        return $fechaFormateada;
    }

    public static function getRow()
    {
        return self::$currentRow;
    }
    protected function applyLineBreaks(array $row)
    {
        foreach ($row as &$value) {
            $value = str_replace(["\r\n", "\r", "\n"], PHP_EOL, $value);
        }

        return $row;
    }
    protected function applyFieldSeparator(array $row)
    {
        if ($this->separadorCampos !== ";") {
            foreach ($row as &$value) {
                $value = str_replace($this->separadorCampos, ";", $value);
            }
        }
        return $row;
    }
    protected function applySpecialCharacters($row)
    {
        foreach ($row as &$value) {
            $value = str_replace([$this->caracterString, '\\' . $this->caracterString], $this->caracterString, $value);
        }

        return $row;
    }

    public function __construct($tipoArchivo, $saltosLinea, $separadorCampos, $caracterString, $lineaDatos, $nombreArchivoOriginal)
    {
        $this->tipoArchivo = $tipoArchivo;
        $this->saltosLinea = $saltosLinea;
        $this->separadorCampos = $separadorCampos;
        $this->caracterString = $caracterString;
        $this->lineaDatos = $lineaDatos;
        $this->nombreArchivoOriginal = $nombreArchivoOriginal;
    }

    public function rules(): array
    {
        dump("reglas");
        return [
            'Date' => 'string',
            'Libelle' => 'string',
            'Montant(EUROS)' => 'numeric',
            'Montant(FRANCS)'  => 'numeric',
            // 'tipo' => Rule::in(['ingreso', 'egreso']),
        ];
    }
    protected function parseRowData(array $row, array $csvSettings)
    {
        // Obtener los nombres de los campos
        $fieldNames = array_keys($row);

        // Crear un array para almacenar los datos procesados
        $data = [];

        // Recorrer los campos y procesar los valores según la configuración
        foreach ($fieldNames as $fieldName) {
            $value = $row[$fieldName];

            // Aplicar la configuración para el campo
            $parsedValue = $this->applyCsvSettings($value, $csvSettings);

            // Guardar el valor procesado en el array de datos
            $data[$fieldName] = $parsedValue;
        }

        // Retornar el array de datos procesados
        return $data;
    }

    protected function applyCsvSettings($value, array $csvSettings)
    {
        dd("llego saltos_linea");
        // Obtener los parámetros de configuración
        $saltosLinea = $csvSettings['saltos_linea'];
        $lineaDatos = $csvSettings['linea_datos'];
        $separadorCampos = $csvSettings['separador_campos'];
        $caracterString = $csvSettings['caracter_string'];

        // Realizar el procesamiento del valor según la configuración
        // Implementa aquí la lógica para aplicar los saltos de línea, separador de campos y caracteres especiales

        return $value;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => $this->separadorCampos,
            'enclosure' => $this->caracterString,
            'input_encoding' => $this->tipoArchivo,
            'eol' => $this->saltosLinea,
            'start_from_row' => $this->lineaDatos,
        ];
    }

    public function createTablaTraspasos()
    {
        try {
            // Verificar si la tabla existe y eliminarla si es necesario
            if (Schema::hasTable('traspaso_bancas')) {
                DB::statement('DROP TABLE traspaso_bancas');
                echo "La tabla traspaso_bancas ha sido eliminada exitosamente.<br>";
            }

            // Crear la tabla traspaso_bancas
            DB::statement('
            CREATE TABLE traspaso_bancas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                Date VARCHAR(10),
                Libelle TEXT,
                MontantEUROS DECIMAL(10, 2),
                MontantFRANCS DECIMAL(10, 2),
                archMov VARCHAR(100)
            )
        ');

            echo "La tabla traspaso_bancas ha sido creada exitosamente.<br>";

            // Vaciar la tabla si tiene datos
            $count = DB::table('traspaso_bancas')->count();
            if ($count > 0) {
                DB::table('traspaso_bancas')->truncate();
                echo "La tabla traspaso_bancas ha sido vaciada.<br>";
            }
        } catch (\Exception $e) {
            echo "Error al crear o vaciar la tabla traspaso_bancas: " . $e->getMessage() . "<br>";
        }
    }
}
