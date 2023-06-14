<?php

namespace App\Imports;

use App\Models\mdlData;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportDatos implements ToModel
{
    public static $table;
    public static $champs1;

    public static $fila = 0;
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
        if (self::$fila == 0) {
            $data = new  mdlData;
            self::$table = $data->table;
            // dd($row);
            $this->sql .= "CREATE TABLE `" . self::$table . "` ( `id` int(11) NOT NULL auto_increment," . PHP_EOL;
            $paso = "`" . implode("` VARCHAR(150) NULL DEFAULT NULL COLLATE `utf8_general_ci`," . PHP_EOL . " `", $row);
            $paso .= "` VARCHAR(50) NULL DEFAULT NULL COLLATE `utf8_general_ci`, ";
            // dd($paso);
            $this->sql .= $paso;

            $this->sql .= " PRIMARY KEY (`id`) );";

            // DB::statement("DROP TABLE self::$table");
            Schema::dropIfExists(self::$table);
            // dump($this->sql);
            DB::statement($this->sql);

            self::$champs1 = $row;
            foreach (self::$champs1 as $key => $value) {
                $values[$value] = $row[$key];
            }

            self::$fila++;
        } else {
            if (!is_null($row[0])) {
                // dump($row);

                foreach (self::$champs1 as $key => $value) {
                    $values[$value] = substr($row[$key], 0, 150);
                }
                // dd($values);
                try {
                    DB::beginTransaction();
                    // database queries here
                    DB::table(self::$table)->insert(
                        $values
                    );
                    // DB::insert("insert into " . self::$table . " (" . self::$champs1 . ") values (" . self::$champs2 . ")", [$row[0], $row[1], $row[2], $row[14], $row[15], $row[38], $row[50], $row[54], $row[56]]);
                    DB::commit();
                } catch (\Exception $e) {
                    // Woopsy
                    DB::rollBack();
                    dd($e);
                }

                self::$fila++;
                // if (self::$fila > 15) {
                //     dd('stop');
                // }
                // if (self::$fila)
                //     return new mdlData($values);
                // else
                return [];
            }
        }
    }
}
