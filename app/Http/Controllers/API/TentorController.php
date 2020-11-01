<?php

namespace App\Http\Controllers\API;

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
            return response()->json(['success' => 'Berhasil menambahkan data'], 200);
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
}
