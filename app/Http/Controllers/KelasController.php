<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\Kelas;
use App\LogPembayaran;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listKelas()
    {
        $data = Kelas::leftJoin('data_tentor as dt', 'dt.id', 'kelas.id_tentor')
            ->leftJoin('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
            ->select('ds.nama as siswa', 'dt.nama as tentor', 'kelas.harga_deal', 'kelas.status', 'kelas.id')
            ->get();
        return view('kelas.index', compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pertemuan = Kelas::join('jadwal', 'jadwal.id_kelas', 'kelas.id')->where('kelas.id', $id)
            ->select('jadwal.hari', 'kelas.tarif', 'kelas.jumlah_pertemuan', 'kelas.pertemuan')->first();

        $dataKelas = Kelas::join('data_mapel as dm', 'dm.id', 'kelas.id_mapel')->where('kelas.id', $id)
            ->select('dm.mapel', 'dm.jenjang', 'dm.kelas', 'kelas.status', 'kelas.id as id_kelas', 'kelas.harga_deal')->first();

        $tentor = Kelas::join('data_tentor as dm', 'dm.id', 'kelas.id_tentor')
            ->join('users', 'users.id', 'dm.id_akun')
            ->where('kelas.id', $id)
            ->select('dm.nama', 'dm.telepon', 'dm.alamat', 'users.email', 'dm.id')->first();

        $siswa = Kelas::join('data_siswa as ds', 'ds.id', 'kelas.id_siswa')
            ->join('users', 'users.id', 'ds.id_akun')
            ->where('kelas.id', $id)
            ->select('ds.nama', 'ds.telepon', 'ds.alamat', 'users.email')->first();

        $jadwal = Jadwal::where('id_kelas', $id)->get();

        $pembayaran = LogPembayaran::where('id_kelas', $id)->get();
        $data['kelas'] = $dataKelas;
        $data['pertemuan'] = $pertemuan;
        $data['tentor'] = $tentor;
        $data['siswa'] = $siswa;
        $data['jadwal'] = $jadwal;
        $data['pembayaran'] = $pembayaran;

        // return $pembayaran;
        return view('kelas.detail', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        //
    }
}
