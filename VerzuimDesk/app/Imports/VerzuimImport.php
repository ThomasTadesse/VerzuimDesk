<?php

namespace App\Imports;

use App\Models\Verzuim;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VerzuimImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Verzuim([
            'datum' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['datum']),
            'groep_code'                            => $row['groep_code'],
            'leeftijd_op_1_10'                      => $row['leeftijd_op_1_10'],
            'naam_docent'                           => $row['naam_docent'],
            'student_naam'                          => $row['student_naam'],
            'studentnummer'                         => $row['studentnummer'],
            'vak'                                   => $row['vak'],
            'percentage_aanwezig'                   => $row['aanwezig'],
            'percentage_geoorloofd_afwezig'         => $row['geoorloofd_afwezig'],
            'percentage_ongeoorloofd_afwezig'       => $row['ongeoorloofd_afwezig'],
            'percentage_niet_geregistreerde_lestijd' => $row['niet_geregistreerde_lestijd'],
        ]);
    }
}
