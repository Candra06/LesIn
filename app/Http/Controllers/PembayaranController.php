<?php

namespace App\Http\Controllers;

use App\LogPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LogPembayaran::leftjoin('data_pembayaran as dp', 'dp.id', 'log_pembayaran.id_pembayaran')
            ->leftJoin('data_siswa as ds', 'ds.id', 'log_pembayaran.created_by')
            ->select('ds.nama', 'log_pembayaran.jumlah_bayar', 'log_pembayaran.status', 'log_pembayaran.tanggal_bayar', 'log_pembayaran.id', 'log_pembayaran.keterangan')
            ->get();
        return view('pembayaran.index', compact('data'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = LogPembayaran::leftjoin('data_pembayaran as dp', 'dp.id', 'log_pembayaran.id_pembayaran')
            ->leftJoin('data_siswa as ds', 'ds.id', 'log_pembayaran.created_by')
            ->where('log_pembayaran.id', $id)
            ->select('log_pembayaran.*', 'log_pembayaran.status as status_pembayaran', 'ds.*', 'log_pembayaran.id as id_log')
            ->first();

        return view('pembayaran.show', compact('data'));
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

        $up['status'] = $request['status'];
        $up['confirmed_by'] = session('id');
        // return $up;
        try {
            LogPembayaran::where('id', $id)->update($up);
            return redirect('/pembayaran')->with('status', 'Berhasil Memverifikasi pembayaran');
        } catch (\Throwable $th) {
            return $th;
            return redirect('/pembayaran/'.$id.'/show')->with('status', 'Gagal Memverifikasi Pembayaran');
        }

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
