<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Kelas;
use App\Siswa;
use App\Tentor;
use DateTime;
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
            'tanggal' => 'required',
        ]);

        try {
            $kelas['id_siswa'] = $request['siswa'];
            $kelas['id_tentor'] = $request['tentor'];
            $kelas['id_mapel'] = $request['mapel'];
            $kelas['tarif'] = $request['tarif'];
            $kelas['harga_deal'] = $request['harga_deal'];
            $kelas['jumlah_pertemuan'] = $request['jumlah_pertemuan'];
            $kelas['pertemuan'] = 0;
            $kelas['status'] = 'Pending';

            Kelas::create($kelas);
            $idKelas = Kelas::latest('id')->first();
            $tanggal = $request['tanggal'];
            for ($i = 0; $i < $request['jumlah_pertemuan']; $i++) {
                $jadwal['id_kelas'] = $idKelas->id;
                $jadwal['hari'] = $request['hari'];
                $jadwal['tanggal'] = $tanggal;
                Jadwal::create($jadwal);
                $date = new DateTime($tanggal);
                $date->modify('+7 day');
                $tanggal = $date->format('Y-m-d');
            }


            return response()->json(['data' => 'Sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
        }
    }

    public function listKelas($user)
    {
        $id = Auth::user()->id;
        if (Auth::user()->role == 'siswa') {
            $siswa = Siswa::where('id_akun', $id)->select('id')->first();
            $data = Kelas::join('data_tentor as dt', 'dt.id', 'kelas.id_tentor')
                ->join('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
                ->join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')
                ->join('users', 'users.id', 'dt.id_akun')
                ->Where('kelas.id_siswa', $siswa->id)
                ->select('kelas.jumlah_pertemuan', 'kelas.pertemuan', 'users.username', 'kelas.id', 'ds.nama', 'dt.nama', 'kelas.id_tentor', 'kelas.id_siswa', 'dm.mapel', 'kelas.harga_deal')
                ->get();
        } else {
            $tentor = Tentor::where('id_akun', $id)->select('id')->first();
            $data = Kelas::join('data_tentor as dt', 'dt.id', 'kelas.id_tentor')
                ->join('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
                ->join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')
                ->join('users', 'users.id', 'ds.id_akun')
                ->where('kelas.id_tentor', $tentor->id)
                ->select('kelas.jumlah_pertemuan', 'kelas.pertemuan', 'users.username', 'kelas.id', 'ds.nama as siswa', 'dt.nama', 'kelas.id_tentor', 'kelas.id_siswa', 'dm.mapel','kelas.harga_deal')
                ->get();
        }

        if ($data) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Gagal memuat data'], 401);
        }
    }

    public function detailKelasBySiswa($kelas)
    {
        $pertemuan = Kelas::join('jadwal', 'jadwal.id_kelas', 'kelas.id')->where('kelas.id', $kelas)
            ->select('jadwal.hari', 'kelas.tarif', 'kelas.jumlah_pertemuan', 'kelas.pertemuan')->first();

        $dataKelas = Kelas::join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')->where('kelas.id', $kelas)
            ->select('dm.mapel', 'dm.jenjang', 'dm.kelas', 'kelas.status', 'kelas.id as id_kelas', 'kelas.harga_deal')->first();

        $tentor = Kelas::join('data_tentor as dm', 'dm.id', 'kelas.id_tentor')
            ->join('users', 'users.id', 'dm.id_akun')
            ->where('kelas.id', $kelas)
            ->select('dm.nama', 'dm.telepon', 'dm.alamat', 'users.email', 'dm.id')->first();

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
            ->select('jadwal.hari', 'kelas.tarif', 'kelas.jumlah_pertemuan', 'kelas.pertemuan')->first();

        $dataKelas = Kelas::join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')->where('kelas.id', $kelas)
            ->select('dm.mapel', 'dm.jenjang', 'dm.kelas', 'kelas.status', 'kelas.id as id_kelas', 'kelas.harga_deal')->first();

        $siswa = Kelas::join('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
            ->join('users', 'users.id', 'ds.id_akun')
            ->where('kelas.id', $kelas)
            ->select('ds.nama', 'ds.telepon', 'ds.alamat', 'users.email')->first();

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
