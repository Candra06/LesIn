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
        $data = Kelas::join('data_tentor as dt', 'dt.id', 'kelas.id_tentor')
        ->join('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
        ->join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')
        ->where('kelas.id_tentor', $user)
        ->orWhere('kelas.id_tentor', $user)
        ->select('kelas.jumlah_pertemuan', 'kelas.pertemuan', 'kelas.id','ds.nama', 'dt.nama','kelas.id_tentor', 'kelas.id_siswa', 'dm.mapel')
        ->get();
        if ($data) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Gagal memuat data'], 401);
        }

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
