<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = Anggota::where('id', 'like', '%' . request('search') . '%')
                ->orwhere('nama_ag', 'like', '%' . request('search') . '%')
                ->orwhere('alamat', 'like', '%' . request('search') . '%')
                ->orwhere('jenis_kelamin', 'like', '%' . request('search') . '%')->paginate(5);
            return view('anggota.index', ['paginate' => $paginate]);
        } else {
            $anggota = Anggota::all(); 
            $paginate = Anggota::orderBy('id', 'asc')->paginate(5);
            return view('anggota.index', ['anggota' => $anggota, 'paginate' => $paginate]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('foto')){
            $image_name = $request->file('foto')->store('images', 'public');
        }

        Anggota::create([
            'nama_ag' => $request->nama,
            'alamat' => $request->alamat,
            'ttl' => $request->ttl,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $image_name,
        ]);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggota = DB::table('anggota')->where('id', $id)->first();
        return view('anggota.detail', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = DB::table('anggota')->where('id', $id)->first();
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nama' => 'required',
        //     'alamat' => 'required',
        //     'ttl' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'foto' => 'required',
        // ]);

        $anggota = Anggota::where('id', $id)->first();
        // $anggota = DB::table('anggota')->where('id_ag', $id)->first();
        if ($anggota->foto && file_exists(storage_path('app/public/' . $anggota->foto))) {
            Storage::delete('public/' . $anggota->foto); 
        }

        $image_name = $request->file('foto')->store('images', 'public');
        $anggota->foto = $image_name;
        // $anggota->foto = $request->get('foto');

        $anggota->nama_ag = $request->get('nama');
        $anggota->alamat = $request->get('alamat');
        $anggota->ttl = $request->get('ttl');
        $anggota->jenis_kelamin = $request->get('jenis_kelamin');
        $anggota->save();
        $anggota->save();
        return redirect()->route('anggota.index')->with('success', 'Data Anggota Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anggota::where('id', $id)->delete();
        return redirect()->route('anggota.index')
        -> with('success', 'Data Anggota Berhasil Dihapus');
    }

    public function cetak($id){
        $anggota = DB::table('anggota')->where('id', $id)->first();
        $pdf = PDF::loadview('anggota.kartu',['anggota'=>$anggota]);
        return $pdf->stream();
    }
}
