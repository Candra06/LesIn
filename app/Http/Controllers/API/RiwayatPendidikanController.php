<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RiwayatPendidikan;

class RiwayatPendidikanController extends Controller
{
    public function riwayat($tentor)
    {
        try {
            $data = RiwayatPendidikan::where('id_tentor', $tentor)->get();
            return response()->json(['data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tentor' =>'required',
            'jenjang_pendidikan' =>'required',
            'status_pendidikan' =>'required',
        ]);

       try {
        $request->all();
        $input['id_tentor'] = $request['id_tentor'];
        $input['jenjang_pendidikan'] = $request['jenjang_pendidikan'];
        $input['status_pendidikan'] = $request['status_pendidikan'];
        if (!$request['tahun_lulus']) {
            $input['tahun_lulus'] = '-';
        }else{
            $input['tahun_lulus'] = $request['tahun_lulus'];
        }
        RiwayatPendidikan::create($input);
        return response()->json(['data' => 'Berhasil menambahkan data'],200);
       } catch (\Throwable $th) {
        return response()->json(['error' => 'Gagal menambah data', 'pesan' => $th], 401);
       }
    }

    public function delete($id)
    {
        try {
            RiwayatPendidikan::where('id', $id)->delete();
            return response()->json(['data' => 'sukses'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Gagal menghapus data', 'pesan' => $th], 401);
        }
    }
}
