<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Siswa;
use App\Tentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function listJadwal()
    {
        $akun = Auth::user()->id;


        if (Auth::user()->role == 'siswa') {
            $id = Siswa::where('id_akun', $akun)->select('id')->first();
            $data = Jadwal::join('kelas', 'kelas.id', 'jadwal.id_kelas')
                ->join('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
                ->join('data_mapel', 'data_mapel.id', 'kelas.id_mapel')
                ->join('data_tentor as dt', 'dt.id', 'kelas.id_tentor')
                ->where('kelas.id_siswa', $id->id)
                ->where('jadwal.tanggal', date('Y-m-d'))
                ->select('data_mapel.mapel', 'kelas.pertemuan', 'kelas.jumlah_pertemuan', 'dt.nama', 'kelas.id')
                ->get();
        } else {
            $id = Tentor::where('id_akun', $akun)->select('id')->first();
            $data = Jadwal::leftjoin('kelas', 'kelas.id', 'jadwal.id_kelas')
            ->leftjoin('data_mapel', 'data_mapel.id', 'kelas.id_mapel')
            ->leftjoin('data_tentor as dt', 'dt.id', 'kelas.id_tentor')
            ->leftjoin('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
            ->where('kelas.id_tentor', $id->id)
            ->where('tanggal',date("Y-m-d"))
            ->select('data_mapel.mapel', 'kelas.pertemuan', 'kelas.jumlah_pertemuan', 'ds.nama', 'kelas.id')
            ->get();
        }
        if ($data) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Gagal memuat data'], 401);
        }
    }


}
