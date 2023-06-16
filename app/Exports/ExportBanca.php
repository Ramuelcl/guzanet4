<?php

namespace App\Exports;

use App\Models\banca\movimientoBanca as Movimientos;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBanca implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Movimientos::all();
    }
}


// <?php

// namespace App\Exports;

// use App\Models\banca\MovimientoBanca;
// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// class ExportBanca implements FromCollection, WithHeadings
// {
//     use Exportable;

//     protected $movimientos;

//     public function __construct($movimientos)
//     {
//         $this->movimientos = $movimientos;
//     }

//     public function collection()
//     {
//         return $this->movimientos;
//     }

//     public function headings(): array
//     {
//         return [
//             'Fecha',
//             'Descripción',
//             'Monto',
//             'Tipo',
//         ];
//     }
// }
