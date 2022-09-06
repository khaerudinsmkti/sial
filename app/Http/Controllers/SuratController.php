<?php

namespace App\Http\Controllers;
use App\Models\Surat;
use Illuminate\Support\Str;
use File;

use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Surat::where('status',0)->orderBy('created_at','DESC')
        ->when(request()->q, function($data){
            $data->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('deskripsi', 'LIKE', '%' .request()->q. '%');
        })->where('status',0)
        ->paginate(8);

        $totalsurat = Surat::where('status',0)->count();

        return view('layouts.surat.suratmasuk', compact('data','totalsurat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surats = Surat::all();

        return view('/layouts/surat/inputsurat', compact('surats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal'        => 'required',
            'status'         => 'required',
            'asal'           => 'required',
            'judul'          => 'required|string|max:100',
            'deskripsi'      => 'required',
            'lampiran'       => 'nullable|mimes:jpeg,png,jpg,pdf|max:5048',
        ]);

        if($request->hasFile('lampiran')){
            $lampiranName = $request->file('lampiran');
            $nama_file = time()."_".$lampiranName->getClientOriginalName();
            $tujuan_upload = 'data_file';
            $lampiranName->move($tujuan_upload,$nama_file);
        }

        Surat::create([
            'status'         => $request->status,
            'tanggal'        => $request->tanggal,
            'judul'          => $request->judul,
            'asal'           => $request->asal,
            'deskripsi'      => $request->deskripsi,
            'lampiran'       => $nama_file,
        ]);

        return redirect( route('surat.index'))->with(['success' => 'Surat Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Surat::findOrFail($id);

        return view('layouts.surat.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Surat::findOrFail($id);

        return view('layouts.surat.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal'        => 'required',
            'status'         => 'required',
            'asal'           => 'required',
            'judul'          => 'required|string|max:100',
            'deskripsi'      => 'required',
            'lampiran'       => 'nullable|mimes:jpeg,png,jpg,pdf|max:5048',
        ]);

        $surat      = Surat::findOrFail($id);
        $nama_file  = $surat->lampiran;

        if($request->hasFile('lampiran')){
            $lampiranName = $request->file('lampiran');
            $nama_file = time()."_".$lampiranName->getClientOriginalName();
            $tujuan_upload = 'data_file';
            $lampiranName->move($tujuan_upload,$nama_file);
            File::delete(public_path('data_file/' .$surat->lampiran));
        }

        $surat->update([
            'status'         => $request->status,
            'tanggal'        => $request->tanggal,
            'judul'          => $request->judul,
            'asal'           => $request->asal,
            'deskripsi'      => $request->deskripsi,
            'lampiran'       => $nama_file,
        ]);

        return redirect( route('surat.index'))->with(['success' => 'Surat berhasil diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Surat::findOrFail($id);
        File::delete(public_path('data_file/' .$data->lampiran));

        $data->delete();

        return redirect( route('surat.index'))->with(['success' => 'Surat berhasil dihapus']);
    }

    public function suratkeluar()
    {
        $data = Surat::where('status',1)->orderBy('created_at','DESC')
        ->when(request()->q, function($data){
            $data->where('judul', 'LIKE', '%' . request()->q . '%')
                ->orWhere('deskripsi', 'LIKE', '%' .request()->q. '%');
        })->where('status',1)
        ->paginate(8);

        $totalsurat = Surat::where('status',1)->count();

        return view('layouts.surat.suratkeluar', compact('data','totalsurat'));
    }
}
