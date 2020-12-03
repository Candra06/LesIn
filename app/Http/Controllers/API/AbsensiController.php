<?php

namespace App\Http\Controllers\API;

use App\Absensi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas)
    {
        try {
            $dt = Absensi::where('id_kelas', $kelas)
                ->get();
                $tmp = [];
                $dm = [];
                foreach ($dt as $d) {
                    $dm['created_at'] =date("Y-m-d", strtotime($d['created_at']));
                    $dm['jam'] =date("H:i:s", strtotime($d['created_at']));
                    $dm['id_kelas'] = $d['id_kelas'];
                    $dm['jurnal'] = $d['jurnal'];
                    $dm['kehadiran'] = $d['kehadiran'];
                    $tmp[] = $dm;
                }
                $data = $tmp;
            return response()->json(['data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
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
            'id_kelas' => 'required',
            'kehadiran' => 'required',
        ]);

        $input['id_kelas'] = $request['id_kelas'];
        $input['kehadiran'] = $request['kehadiran'];
        $input['jurnal'] = $request['jurnal'];
        try {
            Absensi::create($input);
            return response()->json(['data' => 'Berhasil'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 400);
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
        //
    }
}
