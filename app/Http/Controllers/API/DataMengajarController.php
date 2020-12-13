<?php

namespace App\Http\Controllers\API;

use App\DataMengajar;
use App\Http\Controllers\Controller;
use App\Tentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataMengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user()->id;
        $id = Tentor::where('id_akun', $auth)->select('id')->first();
        try {
            $data = DataMengajar::join('data_tentor as dt', 'dt.id', 'data_mengajar.id_tentor')
                ->join('data_mapel', 'data_mapel.id', 'data_mengajar.id_mapel')
                ->where('dt.id', $id->id)
                ->select('dt.nama', 'data_mapel.mapel', 'data_mapel.jenjang', 'data_mapel.kelas', 'data_mengajar.status', 'data_mengajar.id')->get();
            return response()->json(['data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        ]);

        try {
            $input['id_tentor'] = $request['tentor'];
            $input['id_mapel'] = $request['mapel'];
            $input['status'] = 'Aktif';
            DataMengajar::create($input);
            return response()->json(['data' => 'Berhasil menambahkan data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Gagal menambah data', 'pesan' => $th], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DataMengajar::where('id', $id)->delete();
            return response()->json(['data' => 'sukses'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Gagal menghapus data', 'pesan' => $th], 401);
        }
    }
}
