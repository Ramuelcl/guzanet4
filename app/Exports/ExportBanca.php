<?php

namespace App\Exports;

use App\Models\banca\TraspasoBanca as Traspaso;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBanca implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Traspaso::all();
    }
}
