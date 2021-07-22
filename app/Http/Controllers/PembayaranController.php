<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\LogPembayaran;
use App\LogSaldo;
use App\Rekening;
use App\Tentor;
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
        $data = LogPembayaran::leftjoin('kelas as dp', 'dp.id', 'log_pembayaran.id_kelas')
            ->leftJoin('data_siswa as ds', 'ds.id', 'log_pembayaran.created_by')
            ->select('ds.nama', 'log_pembayaran.jumlah_bayar', 'log_pembayaran.status', 'log_pembayaran.tanggal_bayar', 'log_pembayaran.id', 'log_pembayaran.keterangan')
            ->get();
        return view('pembayaran.listPembayaran', compact('data'));
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
        $data = LogPembayaran::leftjoin('kelas as dp', 'dp.id', 'log_pembayaran.id_kelas')
            ->leftJoin('data_siswa as ds', 'ds.id', 'log_pembayaran.created_by')
            ->where('log_pembayaran.id', $id)
            ->select('log_pembayaran.*', 'log_pembayaran.status as status_pembayaran', 'ds.*', 'log_pembayaran.id as id_log')
            ->first();

        return view('pembayaran.detail', compact('data'));
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
        $log = LogPembayaran::leftJoin('kelas as dk', 'dk.id', 'log_pembayaran.id_kelas')
            ->where('log_pembayaran.id', $id)->select('dk.id as id_kelas', 'dk.status', 'dk.harga_deal', 'log_pembayaran.*', 'dk.id_tentor')->first();
            // return $log;


        $up['status'] = $request['status'];
        $up['confirmed_by'] = session('id');
        $sum_pemb = LogPembayaran::where('id_kelas', $log->id_kelas)
            ->where('status', 'Confirmed')
            ->sum('jumlah_bayar');
        $bg_tentor = $log->harga_deal * (70 / 100);
        $total_cek = $log->jumlah_bayar + $sum_pemb;
        $saldo = Tentor::where('id', $log->id_tentor)->first();

        $dp = $log->harga_deal * (30 / 100);

        if ($request['status'] == 'Confirmed') {
            // nambahkan saldo admin
            $rek = Rekening::where('id', $log->id_rekening)->select('saldo')->first();
            $add_saldo = $rek->saldo + $log->jumlah_bayar;
            Rekening::where('id', $log->id_rekening)->update(['saldo' => $add_saldo]);
            if ($total_cek <= $bg_tentor) {

                $saldo_tentor = $saldo->saldo_dompet + $log->jumlah_bayar;
                $inlog = [
                    'id_tentor' => $saldo->id,
                    'jumlah_saldo' => $log->jumlah_bayar,
                    'jenis' => 'Debit',
                    'keterangan' => 'Pembayaran ' . $log->keterangan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                LogSaldo::create($inlog);
                Tentor::where('id', $log->id_tentor)->update(['saldo_dompet' => $saldo_tentor]);
            } else {
                $sisa_tentor = $bg_tentor - $sum_pemb;
                if ($sisa_tentor > 0) {
                    $saldo_tentor = $saldo->saldo_dompet + $sisa_tentor;
                    $inlog = [
                        'id_tentor' => $saldo->id,
                        'jumlah_saldo' => $sisa_tentor,
                        'jenis' => 'Debit',
                        'keterangan' => 'Pembayaran ' . $log->keterangan,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    LogSaldo::create($inlog);
                    Tentor::where('id', $log->id_tentor)->update(['saldo_dompet' => $saldo_tentor]);
                }
            }
        }

        try {
            // return $up;
            // return  intval($dp);
            if ($up['status'] == 'Confirmed' && $log->status == 'Pending' &&  intval($log->jumlah_bayar) >= intval($dp)) {

                Kelas::where('id', $log->id)->update(['status' => 'Aktif']);
            }

            LogPembayaran::where('id', $id)->update($up);
            return redirect('/pembayaran')->with('status', 'Berhasil Memverifikasi pembayaran');
        } catch (\Throwable $th) {
            return $th;
            return redirect('/pembayaran/' . $id . '/show')->with('status', 'Gagal Memverifikasi Pembayaran');
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
