<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Kelas;
use App\Siswa;
use App\Tentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $id = Auth::user()->id;
        $siswa = Siswa::where('id_akun', $id)->select('id')->first();
        $tentor = Tentor::where('id_akun', $id)->select('id')->first();
        $data = Kelas::join('data_tentor as dt', 'dt.id', 'kelas.id_tentor')
        ->join('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
        ->join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')
        ->where('kelas.id_tentor', $tentor)
        ->orWhere('kelas.id_siswa', $siswa)
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
        $pertemuan = Kelas::join('jadwal', 'jadwal.id_kelas', 'kelas.id')->where('kelas.id', $kelas)
        ->select('jadwal.hari', 'jadwal.jam', 'kelas.tarif', 'kelas.jumlah_pertemuan', 'kelas.pertemuan')->first();

        $dataKelas = Kelas::join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')->where('kelas.id', $kelas)
        ->select('dm.mapel', 'dm.jenjang', 'dm.kelas', 'kelas.status', 'kelas.id as id_kelas')->first();

        $tentor = Kelas::join('data_tentor as dm', 'dm.id', 'kelas.id_tentor')
        ->join('users', 'users.id', 'dm.id_akun')
        ->where('kelas.id', $kelas)
        ->select('dm.nama', 'dm.telepon', 'dm.wa', 'dm.alamat', 'users.email')->first();

        $data = array();
        $data['pertemuan'] = $pertemuan;
        $data['dataKelas'] = $dataKelas;
        $data['mentor'] = $tentor;
        if ($pertemuan && $dataKelas && $tentor) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Gagal memuat data'], 401);
        }


    }

    public function detailKelasByTentor($kelas)
    {
        $pertemuan = Kelas::join('jadwal', 'jadwal.id_kelas', 'kelas.id')->where('kelas.id', $kelas)
        ->select('jadwal.hari', 'jadwal.jam', 'kelas.tarif', 'kelas.jumlah_pertemuan', 'kelas.pertemuan')->first();

        $dataKelas = Kelas::join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')->where('kelas.id', $kelas)
        ->select('dm.mapel', 'dm.jenjang', 'dm.kelas', 'kelas.status', 'kelas.id as id_kelas')->first();

        $siswa = Kelas::join('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
        ->join('users', 'users.id', 'ds.id_akun')
        ->where('kelas.id', $kelas)
        ->select('ds.nama', 'ds.telepon', 'ds.wa', 'ds.alamat', 'users.email')->first();

        $data = array();
        $data['pertemuan'] = $pertemuan;
        $data['dataKelas'] = $dataKelas;
        $data['siswa'] = $siswa;
        if ($pertemuan && $dataKelas && $siswa) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Gagal memuat data'], 401);
        }


    }

    public function accKelas($kelas)
    {
        
    }


}
