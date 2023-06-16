<?php

namespace App\Imports;

use App\Models\banca\TraspasoBanca;
//
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
//
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

use Maatwebsite\Excel\Concerns\FromCollection;


class TraspasoBancaImport implements ToModel, WithHeadingRow, WithStartRow
{

    protected $separadorCampos;
    protected $caracterString;
    protected $saltosLinea;
    protected $lineaDatos;
    protected $nombreOriginal;
    protected $tipoArchivo;
    //
    public static $titulos = 48;
    public static $fila = 0;
    public static $columnas;

    public function __construct($separadorCampos, $caracterString, $saltosLinea, $lineaDatos, $nombreOriginal, $tipoArchivo)
    {
        $this->separadorCampos = $separadorCampos;
        $this->caracterString = $caracterString;
        $this->saltosLinea = $saltosLinea;
        $this->lineaDatos = $lineaDatos;
        $this->nombreOriginal = $nombreOriginal;
        $this->tipoArchivo = $tipoArchivo;

        $this->getCsvSettings();
    }

    public function model(array $row)
    {
        if (self::$fila === 0) {
            $this->createTablaTraspasos();
            $this->headingRow($row);
            self::$fila++;
            return [];
        }

        $row[1] = ',' . $row[1];
        $row[2] = ',' . $row[2];
        $row = implode('', $row);
        $row = fncCambiaCaracteresEspeciales($row);
        $row = explode($this->separadorCampos, $row);
        // dd($row);
        // Realiza la conversión de codificación de los caracteres

        // sleep(10);
        // dd(['row' => $row, 'columnas' => self::$columnas, 'fila' => self::$fila]);
        // Obtener los valores de cada columna utilizando los títulos convertidos
        $date = $row[0];
        $libelle = trim(str_replace('"', '', $row[1]));
        // $libelle = trim(str_replace('"', '', $libelle));
        $montantEUROS = $row[2];
        $montantFRANCS = $row[3];
        dump(['date' => $date, 'Libelle' => $libelle, 'MontantEUROS' => $montantEUROS, 'MontantFRANCS' => $montantFRANCS, 'NomArchTras' => $this->nombreOriginal, 'fila' => self::$fila]);
        // Crear el modelo TraspasoBanca con los valores obtenidos
        self::$fila++;
        $Traspaso = new TraspasoBanca([
            'Date' => $date,
            'Libelle' => $libelle,
            'MontantEUROS' => $montantEUROS,
            'MontantFRANCS' => $montantFRANCS,
            'NomArchTras' => $this->nombreOriginal
        ]);
        $Traspaso->save();
        // dd($Traspaso);   
        return $Traspaso;
    }

    public function getCsvSettings(): array
    {
        // dump([
        //     'delimiter' => $this->separadorCampos,
        //     'lineEnding' => $this->saltosLinea,
        //     'eol' => $this->saltosLinea,
        //     'enclosure' => $this->caracterString,
        //     'input_encoding' => $this->tipoArchivo,
        //     'start_from_row' => $this->lineaDatos,
        //     'skip_rows' => $this->lineaDatos,
        // ]);
        return [
            'delimiter' => $this->separadorCampos,
            //
            'lineEnding' => $this->saltosLinea,
            'eol' => $this->saltosLinea,
            //
            'enclosure' => $this->caracterString,
            'input_encoding' => $this->tipoArchivo,
            //
            'start_from_row' => $this->lineaDatos,
            'skip_rows' => $this->lineaDatos,
            //
            'encoding' => 'UTF-8',
        ];
    }

    public function headingRow($row = null): int
    {
        // if (!is_null($row)) {
        //     // // Convertir los títulos de las columnas a minúsculas
        //     self::$columnas = array_map('mb_strtolower', array_keys($row));
        //     // dump(['row' => $row, 'columnas' => self::$columnas, 'fila' => self::$fila]);
        //     // sleep(5);
        // }
        return $this->lineaDatos; // Indica que el encabezado se encuentra en la fila x
    }

    public function startRow(): int
    {
        return $this->headingRow() + 1; // Salta automáticamente a la línea después del encabezado
    }

    public function headingRowFormatter(): HeadingRowFormatter
    {
        return new HeadingRowFormatter(function ($value) {
            // Aplica cualquier lógica de formateo que desees
            return strtoupper($value);
        });
    }

    public function createTablaTraspasos()
    {
        try {
            // Verificar si la tabla existe y eliminarla si es necesario
            // if (Schema::hasTable('traspaso_bancas')) {
            //     DB::statement('DROP TABLE traspaso_bancas');
            //     echo "La tabla traspaso_bancas ha sido eliminada exitosamente.<br>";
            // }

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
            }
            echo "La tabla traspaso_bancas ha sido creada exitosamente.<br>";

            // Vaciar la tabla si tiene datos
            // $count = DB::table('traspaso_bancas')->count();
            // if ($count > 0) {
            //     DB::table('traspaso_bancas')->truncate();
            //     echo "La tabla traspaso_bancas ha sido vaciada.<br>";
            // }
        } catch (\Exception $e) {
            echo "Error al crear o vaciar la tabla traspaso_bancas: " . $e->getMessage() . "<br>";
        }
    }
}
