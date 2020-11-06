<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\LogPembayaran;
use App\Pembayaran;
use App\Siswa;
use App\Tentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function pembayaran(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'harga_deal' => 'required',
            'bukti_tf' => 'file|between:0,2048|mimes:png,jpg,jpeg',
            'tanggal_bayar' => 'required',
            'jumlah_bayar' => 'required',
        ]);
        $user = Auth::user()->id;
        $idSiswa = Siswa::where('id_akun', $user)->select('id')->first();
        $fileType = $request->file('bukti_tf')->extension();
        $name = Str::random(8) . '.' . $fileType;

        $cek = Pembayaran::where('id_kelas', $request['id_kelas'])->first();
        if ($cek) {
            $log['id_pembayaran'] = $cek->id;
            $log['bukti_tf'] = Storage::putFileAs('bukti', $request->file('bukti_tf'), $name);
            $log['tanggal_bayar'] = $request['tanggal_bayar'];
            $log['jumlah_bayar'] = $request['jumlah_bayar'];
            $log['created_by'] = $idSiswa->id;
            $log['confirmed_by'] = 0;
            $log['status'] = 'Pending';
            try {
                LogPembayaran::create($log);
                $pembayaran = LogPembayaran::where('id_pembayaran', $cek->id)->where('status', 'Confirmed')->sum('jumlah_bayar');
                if ($cek->harga_deal == $pembayaran) {
                    Pembayaran::where('id', $cek->id)->update(['status_pembayaran' => 'Lunas']);
                }
                return response()->json(['data' => 'Berhassil melakukan pembayaran'], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th], 401);
            }
        } else {
            $pembayaran['id_kelas'] = $request['id_kelas'];
            $pembayaran['harga_deal'] = $request['harga_deal'];
            $pembayaran['status_pembayaran'] = 'Belum Lunas';
            $pembayaran = Pembayaran::create($pembayaran);
            $idPembayaran = $pembayaran->id;
            $log['id_pembayaran'] = $idPembayaran;
            $log['bukti_tf'] = Storage::putFileAs('bukti', $request->file('bukti_tf'), $name);
            $log['tanggal_bayar'] = $request['tanggal_bayar'];
            $log['jumlah_bayar'] = $request['jumlah_bayar'];
            $log['created_by'] = $idSiswa->id;
            $log['confirmed_by'] = 0;
            $log['status'] = 'Pending';
            try {
                LogPembayaran::create($log);
                return response()->json(['data' => 'Berhasil menambahkan data'], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }
    }

    public function logPembayaran($kelas)
    {
        $data = LogPembayaran::leftJoin('data_pembayaran', 'data_pembayaran.id', 'log_pembayaran.id_pembayaran')->where('data_pembayaran.id_kelas', $kelas)->get();
        if ($data) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

    public function konfirmasi(Request $request, $log)
    {
        $request->validate([
            'status' => 'required'
        ]);
        $auth = Auth::user()->id;
        $id = Tentor::where('id_akun', $auth)->select('id')->first();
        $cek = LogPembayaran::leftjoin('data_pembayaran', 'data_pembayaran.id', 'log_pembayaran.id_pembayaran')
            ->leftjoin('kelas', 'kelas.id', 'data_pembayaran.id_kelas')
        ->where('log_pembayaran.id', $log)->select('kelas.status', 'kelas.id')->first();
        $up['status'] = $request['status'];
        $up['confirmed_by'] = $id;
        if ($up['status'] == 'Confirmed' && $cek->status == 'Pending') {
            Kelas::where('id', $cek->id)->update(['status' => 'Aktif']);
        }

        try {
            LogPembayaran::where('id', $log)->update($up);
            return response()->json(['data' => 'Berhasil mengkonfirmasi pembayaran'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
