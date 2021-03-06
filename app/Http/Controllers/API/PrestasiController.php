<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function addPrestasi(Request $request)
    {
        $request->validate([
            'tentor' => 'required',
            'tingkatan' => 'required',
            'penghargaan' => 'required'
        ]);

        try {
            $input['id_tentor'] = $request['tentor'];
            $input['tingkatan'] = $request['tingkatan'];
            $input['penghargaan'] = $request['penghargaan'];
            $input['status'] = 'Show';

            Prestasi::create($input);
            return response()->json(['data' => 'sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Gagal menambah data'], 401);
        }
    }

    public function getPrestasi($tentor)
    {
        $data = Prestasi::where('id_tentor', $tentor)->where('status', 'Show')->get();
        if ($data) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Gagal mengakses data'], 401);
        }

    }

    public function delete($id)
    {
        $update = ['status' => 'Hide', 'updated_at'=> date('Y-m-d H:i:s')];
        try {

            Prestasi::where('id', $id)->update($update);
            return response()->json(['data' => 'sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $id, 'message' => $th], 401);
        }
    }


}
