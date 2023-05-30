<?php

namespace App\Exports;

use App\Models\mdlData;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDatos implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return mdlData::all();
    }
}
