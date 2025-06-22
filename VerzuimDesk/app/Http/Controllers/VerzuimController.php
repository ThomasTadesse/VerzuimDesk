<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verzuim;
use App\Imports\VerzuimImport;
use Maatwebsite\Excel\Facades\Excel;

class VerzuimController extends Controller
{

    /**
     * Show the form for uploading a file.
     *
     * @return \Illuminate\View\View
     */

     public function form() {
        return view('verzuim.upload');
    }

    public function import(Request $request)
    {
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    Excel::import(new VerzuimImport, $request->file('file'));

    return back()->with('success', 'Verzuimgegevens succesvol geïmporteerd!');
    }

    public function upload(Request $request) {
    $request->validate(['file' => 'required|mimes:xlsx,xls']);
    Excel::import(new VerzuimImport, $request->file('file'));
    return redirect('/select-klas');
    }

    public function selectForm() {
    $klassen = Verzuim::select('klas')->distinct()->pluck('klas');
    return view('verzuim.select', compact('klassen'));
    }

    public function showAverage(Request $request) {
    $request->validate(['klas' => 'required']);
    $gemiddelde = Verzuim::where('klas', $request->klas)->avg('verzuimuren');
    return view('verzuim.resultaat', [
        'klas' => $request->klas,
        'gemiddelde' => round($gemiddelde, 2)
    ]);
    }

    public function toonKlas($klas) {
    $studenten = Verzuim::where('klas', $klas)
        ->select('leerling', \DB::raw('SUM(verzuimuren) as totaal_verzuim'))
        ->groupBy('leerling')
        ->orderBy('leerling')
        ->get();

    $gemiddelde = round($studenten->avg('totaal_verzuim'), 2);

    return view('verzuim.klas_detail', compact('klas', 'studenten', 'gemiddelde'));
}


    public function index()
    {
        $verzuim = Verzuim::all();
        return view('verzuim.index', compact('verzuim'));
    }
}
