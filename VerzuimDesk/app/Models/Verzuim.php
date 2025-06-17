<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verzuim extends Model
{
    use HasFactory;

    protected $table = 'verzuim';

    protected $fillable = [
        'datum',
        'groep_code',
        'leeftijd_op_1_10',
        'naam_docent',
        'student_naam',
        'studentnummer',
        'vak',
        'percentage_aanwezig',
        'percentage_geoorloofd_afwezig',
        'percentage_ongeoorloofd_afwezig',
        'percentage_niet_geregistreerde_lestijd',
    ];

    protected $casts = [
        'datum' => 'datetime',
        'percentage_aanwezig' => 'float',
        'percentage_geoorloofd_afwezig' => 'float',
        'percentage_ongeoorloofd_afwezig' => 'float',
        'percentage_niet_geregistreerde_lestijd' => 'float',
    ];
}
