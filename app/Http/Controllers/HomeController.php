<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $surat = Surat::count();
        $suratmasuk = Surat::where('status',0)->count();
        $suratkeluar = Surat::where('status',1)->count();
        $suratkeluar = Surat::where('status',1)->count();
        $suratbulanini = Surat::whereMonth('tanggal', Carbon::now()->month)->count();
        //$pengirimsurat = Surat::get()->groupBy('asal');

        $pengirimsurat = DB::table('surats')
                 ->select('asal', DB::raw('count(*) as total'))
                 ->groupBy('asal')
                 ->get();
        //dd($pengirimsurat);



        return view('home', compact('surat','suratmasuk','suratkeluar','suratbulanini','pengirimsurat'));
    }
}
