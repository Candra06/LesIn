<?php

namespace App\Http\Controllers;

use App\DataMengajar;
use App\Mapel;
use App\Tentor;
use Illuminate\Http\Request;

class DataMengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DataMengajar::join('data_tentor as dt', 'dt.id', 'data_mengajar.id_tentor')
        ->join('data_mapel', 'data_mapel.id', 'data_mengajar.id_mapel')
        ->select('dt.nama', 'data_mapel.mapel', 'data_mapel.jenjang', 'data_mapel.kelas', 'data_mengajar.status')->get();
        return view('dataMengajar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tentor = Tentor::where('status', 'Aktif')->get();
        $mapel = Mapel::where('status', 'Aktif')->get();
        return view('dataMengajar.add', compact('tentor', 'mapel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tentor' => 'required',
            'mapel' => 'required',
            'status' => 'required',
        ]);

        try {
            $input['id_tentor'] = $request['tentor'];
            $input['id_mapel'] = $request['mapel'];
            $input['status'] = $request['status'];
            DataMengajar::create($input);
            return redirect('/dataMengajar')->with('status', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            return redirect('/dataMengajar/create')->with('status', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataMengajar  $dataMengajar
     * @return \Illuminate\Http\Response
     */
    public function show(DataMengajar $dataMengajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataMengajar  $dataMengajar
     * @return \Illuminate\Http\Response
     */
    public function edit(DataMengajar $dataMengajar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataMengajar  $dataMengajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataMengajar $dataMengajar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataMengajar  $dataMengajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataMengajar $dataMengajar)
    {
        //
    }
}
