<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function showMapel()
    {
        $mapel = Mapel::all();
        if ($mapel) {
            return response()->json(['success' => $mapel], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

    public function mapelByKey($kelas='', $mapel = '')
    {
        $mapel = Mapel::where('kelas', $kelas)->where('mapel', $mapel)->get();
        if ($mapel) {
            return response()->json(['data' => $mapel], 200);
        } else {
            return response()->json(['error' => 'data tidak ditemukan'], 401);
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required',
            'jenjang' => 'required',
            'kelas' => 'required',
        ]);
        try {
            $request->all();
            $input['mapel'] = $request['mapel'];
            $input['jenjang'] = $request['jenjang'];
            $input['kelas'] = $request['kelas'];
            Mapel::create($input);
            return response()->json(['success' => 'Berhasil menambah data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed input data', 'message' =>$th], 401);
        }

    }
}
