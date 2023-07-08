<?php

namespace App\Imports;

use Exception;

class clsFileReader
{
    private $filePath;
    private $separadorCampos;
    private $caracterString;
    private $finLinea;
    private $lineaEncabezados;

    protected $file;
    protected $handle;
    protected $encoding = 'UTF-8';
    protected $fileType;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->determinarOpcionesPorDefecto();
    }

    public function setConfig($cnf)
    {
        $this->letSeparadorCampos($cnf['separadorCampos']);
        $this->letCaracterString($cnf['caracterString']);
        $this->letFinLinea($cnf['finLinea']);
        $this->letLineaEncabezado($cnf['lineaEncabezados']);
    }

    public function letSeparadorCampos($valor = null, $default = ';')
    {
        if ($valor !== null) {
            $this->separadorCampos = $valor;
        }
        return $this->separadorCampos ?? $default;
    }

    public function letCaracterString($valor = null, $default = '"')
    {
        if ($valor !== null) {
            $this->caracterString = $valor;
        }
        return $this->caracterString ?? $default;
    }

    public function letFinLinea($valor = null, $default = '\r\n')
    {
        if ($valor !== null) {
            $this->finLinea = $valor;
        }
        return $this->finLinea ?? $default;
    }

    public function letLineaEncabezado($valor = null,  $default = 1)
    {
        if ($valor !== null) {
            $this->lineaEncabezados = $valor;
        }
        return $this->lineaEncabezados ?? $default;
    }

    public function readLines()
    {
        // dump($this->handle);

        // Obtener la siguiente línea del archivo
        $linea  = fgets($this->handle);
        // Convertir el tipo MIME al encoding especificado
        // $linea = mb_convert_encoding($linea, $this->encoding); //'Windows-1252' , 'auto'

        // Verificar si se llegó al final del archivo
        if ($linea === false) {
            return false;
        }

        // Verificar si la línea está vacía
        if (empty(trim($linea))) {
            // Saltar a la siguiente iteración del bucle sin procesar la línea vacía
            // $this->readlines();
        }

        // Convertir la línea si está en formato de cadena de bytes
        try {
            $linea = fncConvertirCadenaBytes($linea);
        } catch (\Throwable $th) {
            //throw $th;
        }

        // Devolver la línea completa
        return $linea;
    }

    public function parseLine($line, $array = [])
    {
        $arrayAsoc = [];

        $fields = fncExplode($line, $this->separadorCampos, $this->finLinea);

        $fields = $this->parseLine3($fields);
        // dump(["quitó fin de linea y caracter de string" => $fields]);
        try {
            if ($array) {
                foreach ($array as $key => $value) {
                    if (isset($fields[$key]))
                        $arrayAsoc["$value"] = $fields[$key];
                }
                $fields = $arrayAsoc;
            }
        } catch (\Throwable $th) {
            dd($th);
            throw $th;
        }
        // dump(["asoció los datos" => $fields]);

        return $fields;
    }
    public function parseLine3($fields)
    {
        foreach ($fields as &$field) {
            // quitar el caracter de string EXTRA
            $field = str_replace($this->caracterString, "", $field);
        }

        return $fields;
    }

    public function determinarOpcionesPorDefecto()
    {
        $extension = pathinfo($this->filePath, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'csv':
                $this->separadorCampos = ';';
                $this->caracterString = '"';
                $this->finLinea = "\r\n";
                $this->lineaEncabezados = true;
                break;
            case 'txt':
                $this->separadorCampos = '\t';
                $this->caracterString = '"';
                $this->finLinea = "\n";
                $this->lineaEncabezados = false;
                break;
            case 'tsv':
                $this->separadorCampos = '\t';
                $this->caracterString = '"';
                $this->finLinea = "\n";
                $this->lineaEncabezados = true;
                break;
            default:
                // Opciones por defecto en caso de extensión desconocida
                $this->separadorCampos = ';';
                $this->caracterString = '"';
                $this->finLinea = "\r\n";
                $this->lineaEncabezados = true;
                break;
        }
    }

    public function open($filePath)
    {
        // dump(realpath($filePath));

        if ($this->handle) {
            $this->close();
        }

        if (!empty($filePath)) {
            if (file_exists($filePath)) {

                // Obtener el tipo MIME del archivo
                $this->fileType = $this->getFileMimeType($filePath);

                $this->file = $filePath;
                $this->handle = fopen($this->file, 'r');

                if ($this->handle === false) {
                    // Error al abrir el archivo
                    throw new Exception("Error al abrir el archivo: " . $filePath);
                }
            } else {
                // El archivo no existe
                throw new Exception("El archivo no existe: " . $filePath);
            }
        } else {
            // La ruta del archivo está vacía
            throw new Exception("La ruta del archivo está vacía");
        }
    }

    public function close()
    {
        if ($this->handle) {
            fclose($this->handle);
            $this->handle = null;
            $this->file = null;
        }
    }

    protected function getFileMimeType($filePath)
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($fileInfo, $filePath);
        finfo_close($fileInfo);

        return $fileType;
    }
}
