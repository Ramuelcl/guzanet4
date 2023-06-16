<?php

namespace App\Imports;

use App\Models\banca\TraspasoBanca as Traspaso;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBanca implements ToModel
{
    public static $table = 'traspaso_bancas';
    public static $champs1;

    public static $fila = 0;
    public static $titulos = 8;
    public static $string = "";

    public $sql = "";
    //     create database if not exists `test`;
    //     USE `test`;
    //     SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; /*Table structure for table `test` */
    // ";
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // Verificar si la línea actual está después de la línea de titulos
        $pos = strpos($row['numro_compte_5578733w020'], "Date;Libell");
        dump([self::$currentRow, $row, $pos]);

        // cambio la linea donde están los datos, ya que encontré los títulos
        if ($pos === 0) self::$titulos = self::$fila + 1;

        if (self::$fila >= self::$titulos) {
            dump(['row' => $row]);
            return new Traspaso([
                // 'id'     => $row[0],
                'Date'     => $row[0],
                'Libelle'    => $row[1],
                'MontantEUROS'    => $row[2],
                'MontantFRANCS'    => $row[3],
                // 'dupTxt'    => $row[5],
                // 'archivado'    => $row[6],
            ]);
        } elseif (self::$fila === 0) {
            // $data = new  Traspaso;

            $this->sql = "CREATE TABLE `traspaso_bancas` (
                `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                `Date` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                `libelle` TEXT NOT NULL COLLATE 'utf8_general_ci',
                `MontantEUROS` DECIMAL(8,2) NULL DEFAULT '0',
                `MontantFRANCS` DECIMAL(8,2) NULL DEFAULT '0',
                `archivo` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
                `dupTxt` TEXT NOT NULL COLLATE 'utf8_general_ci',
                `archMov` BIGINT(20) UNSIGNED NULL DEFAULT '0',
                PRIMARY KEY (`id`) USING BTREE
            ) COLLATE='utf8_general_ci' ENGINE=InnoDB;";

            dump(['sql' => $this->sql, 'table' => self::$table]);

            // DB::statement("DROP TABLE self::$table");
            Schema::dropIfExists('traspaso_bancas');
            // dump($this->sql);
            DB::statement($this->sql);

            // self::$champs1 = $row;
            // foreach (self::$champs1 as $key => $value) {
            //     $values[$value] = $row[$key];
            // }

            // } else {
            //     if (!is_null($row[0])) {
            //         // dump($row);

            //         foreach (self::$champs1 as $key => $value) {
            //             $values[$value] = substr($row[$key], 0, 150);
            //         }
            // dd($values);
            // try {
            //     DB::beginTransaction();
            //     // database queries here
            //     DB::table(self::$table)->insert(
            //         $values
            //     );
            //     // DB::insert("insert into " . self::$table . " (" . self::$champs1 . ") values (" . self::$champs2 . ")", [$row[0], $row[1], $row[2], $row[14], $row[15], $row[38], $row[50], $row[54], $row[56]]);
            //     DB::commit();
            // } catch (\Exception $e) {
            //     // Woopsy
            //     DB::rollBack();
            //     dd($e);
            // }

            // self::$fila++;
            // if (self::$fila > 15) {
            //     dd('stop');
            // }
            // if (self::$fila)
            //     return new mdlData($values);
            // else
        }
        self::$fila++;
        return [];
    }
}
