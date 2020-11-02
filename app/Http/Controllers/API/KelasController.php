<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function addKelas(Request $request)
    {
        $request->validate([
            'siswa' => 'required',
            'tentor' => 'required',
            'mapel' => 'required',
            'tarif' => 'required',
            'jumlah_pertemuan' => 'required',
            'hari' => 'required',
            'jam' => 'required',
        ]);

        try {
            $kelas['id_siswa'] = $request['siswa'];
            $kelas['id_tentor'] = $request['tentor'];
            $kelas['id_mapel'] = $request['mapel'];
            $kelas['tarif'] = $request['tarif'];
            $kelas['jumlah_pertemuan'] = $request['jumlah_pertemuan'];
            $kelas['pertemuan'] = 0;
            $kelas['status'] ='Pending';

            Kelas::create($kelas);
            $idKelas = Kelas::latest('id')->first();

            $jadwal['id_kelas'] = $idKelas->id;
            $jadwal['hari'] = $request['hari'];
            $jadwal['jam'] = $request['jam'];
            Jadwal::create($jadwal);
            return response()->json(['data' => 'Sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Gagal menambah data'], 401);
        }
    }

    public function listKelas($user)
    {
        # code...
    }

    public function detailKelasBySiswa($kelas)
    {
        # code...
    }

    public function detailKelasByTentor($kelas)
    {
        # code...
    }

    public function accKelas($kelas)
    {
        # code...
    }


}
