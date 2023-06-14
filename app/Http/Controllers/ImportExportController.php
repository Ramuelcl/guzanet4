<?php

namespace App\Http\Controllers;

// use App\Exports\ExportDatos;
use Illuminate\Http\Request;
// use App\Imports\ImportDatos;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function importExport()
    {
        return view('import');
    }

    public function export()
    {
        return Excel::download(new \App\Exports\ExportDatos, 'datos.xlsx');
    }

    public function import()
    {
        try {
            Excel::import(new \App\Imports\ImportBanca, request()->file('file'));
            //$paso = // dd($paso);
        } catch (\Exception $e) {
            // Woopsy
            //            dd($e);
        }

        return back();
    }
}
