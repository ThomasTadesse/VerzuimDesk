<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verzuim;
use App\Imports\VerzuimImport;
use Maatwebsite\Excel\Facades\Excel;

class VerzuimController extends Controller
{
    public function import(Request $request)
    {
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    Excel::import(new VerzuimImport, $request->file('file'));

    return back()->with('success', 'Verzuimgegevens succesvol geïmporteerd!');
    }
}
