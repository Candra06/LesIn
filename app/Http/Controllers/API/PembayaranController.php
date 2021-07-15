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
            'keterangan' => 'required',
            'bukti_tf' => 'file|between:0,2048|mimes:png,jpg,jpeg',
            'tanggal_bayar' => 'required',
            'jumlah_bayar' => 'required',
            'id_rekening' => 'required',
        ]);
        $user = Auth::user()->id;
        $idSiswa = Siswa::where('id_akun', $user)->select('id')->first();
        $fileType = $request->file('bukti_tf')->extension();
        $name = Str::random(8) . '.' . $fileType;

        $cek = LogPembayaran::where('id_kelas', $request['id_kelas'])->first();
        // return $cek;
        if ($cek) {

            $log['id_kelas'] = $request['id_kelas'];
            $log['bukti_tf'] = Storage::putFileAs('bukti', $request->file('bukti_tf'), $name);
            $log['tanggal_bayar'] = $request['tanggal_bayar'];
            $log['jumlah_bayar'] = $request['jumlah_bayar'];
            $log['created_by'] = $idSiswa->id;
            $log['keterangan'] = $request['keterangan'];
            $log['id_rekening'] = $request['id_rekening'];
            // $log['confirmed_by'] = 0;
            $log['status'] = 'Pending';
            $log['created_at'] = date('Y-m-d H:i:s');
            try {
                LogPembayaran::create($log);
                $pembayaran = LogPembayaran::where('id_kelas', $cek->id)->where('status', 'Confirmed')->sum('jumlah_bayar');
                if ($cek->harga_deal == $pembayaran) {
                    Pembayaran::where('id', $cek->id)->update(['status_pembayaran' => 'Lunas']);
                }
                return response()->json(['data' => 'Berhassil melakukan pembayaran'], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th], 401);
            }
        } else {
            // return 'gak dapat';

            $log['id_kelas'] = $request['id_kelas'];
            $log['bukti_tf'] = Storage::putFileAs('bukti', $request->file('bukti_tf'), $name);
            $log['tanggal_bayar'] = $request['tanggal_bayar'];
            $log['jumlah_bayar'] = $request['jumlah_bayar'];
            $log['created_by'] = $idSiswa->id;
            // $log['confirmed_by'] = 0;
            $log['keterangan'] = $request['keterangan'];
            $log['id_rekening'] = $request['id_rekening'];
            $log['status'] = 'Pending';
            try {
                LogPembayaran::create($log);
                return response()->json(['data' => 'Berhasil menambahkan data'], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Unauthorized', 'message' => $th], 401);
            }
        }
    }

    public function logPembayaran($kelas)
    {
        $total = LogPembayaran::where('id_kelas', $kelas)->sum('jumlah_bayar');
        $data = LogPembayaran::leftJoin('kelas', 'kelas.id', 'log_pembayaran.id_kelas')->where('kelas.id', $kelas)
            ->select('log_pembayaran.id_kelas', 'log_pembayaran.id as id', 'log_pembayaran.bukti_tf', 'log_pembayaran.tanggal_bayar', 'log_pembayaran.jumlah_bayar', 'log_pembayaran.created_by', 'log_pembayaran.keterangan', 'log_pembayaran.status')->get();
        $deal = Kelas::where('id', $kelas)->select('harga_deal')->first();
        $sisa = intval($deal->harga_deal) - intval($total);
        if ($data) {
            return response()->json(['terbayar' => $total, 'deal' => $deal->harga_deal, 'sisa' => $sisa, 'data' => $data,], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function listPembayaran()
    {
        $auth = Auth::user()->id;
        $id = Siswa::where('id_akun', $auth)->select('id')->first();

        $data = LogPembayaran::leftJoin('kelas', 'kelas.id', 'log_pembayaran.id_kelas')
            ->leftJoin('data_siswa', 'data_siswa.id', 'kelas.id_siswa')
            ->where('data_siswa.id', $id->id)
            ->select('log_pembayaran.keterangan', 'log_pembayaran.tanggal_bayar', 'log_pembayaran.jumlah_bayar', 'log_pembayaran.status', 'data_siswa.id')
            ->get();
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
        // return $id->id;
        $up['status'] = $request['status'];
        $up['confirmed_by'] = $id->id;

        if ($up['status'] == 'Confirmed' && $cek->status == 'Pending' && $cek != null) {
            Kelas::where('id', $cek->id)->update(['status' => 'Aktif']);
        }

        try {

            LogPembayaran::where('id', $log)->update($up);
            return response()->json(['data' => 'Berhasil mengkonfirmasi pembayaran'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized', 'message' => $th], 401);
        }
    }
}
