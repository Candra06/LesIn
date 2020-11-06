<?php

namespace App\Http\Controllers\API;

use App\DataMengajar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tentor;

class TentorController extends Controller
{
    public function addInfoTentor(Request $request, $tentor)
    {

        try {
            $input['hobi'] = $request['hobi'];
            $input['motto'] = $request['motto'];
            // return response()->json(['success' => $tentor], 200);
            Tentor::where('id', $tentor)->update($input);
            return response()->json(['data' => 'Berhasil menambahkan data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized', 'pesan' => $th], 401);
        }
    }

    public function getInfoTentor($tentor)
    {
        try {
            $data = Tentor::where('id', $tentor)->first();
            return response()->json(['data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function addDataMengajar(Request $request)
    {
        $request->validate([
            'tentor' => 'required',
            'mapel' => 'required',
        ]);

        try {
            $input = $request->all();
            $input['id_mapel'] = $request['mapel'];
            $input['id_tentor'] = $request['tentor'];
            DataMengajar::create($input);
            return response()->json(['data' => 'Sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed'], 401);
        }
    }

    public function getListTentor($mapel)
    {
        $dataMengajar = DataMengajar::join('data_tentor as dt', 'dt.id', 'data_mengajar.id_tentor')->where('id_mapel', $mapel)->get();
        if ($dataMengajar) {
            return response()->json(['data' => $dataMengajar],200);
        } else {
            return response()->json(['error' => 'Failed getting data'], 401);
        }

    }

    public function deleteDataMengajar($id)
    {
        try {
            DataMengajar::where('id', $id)->delete();
            return response()->json(['data' => 'Sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed'], 401);
        }
    }
}
