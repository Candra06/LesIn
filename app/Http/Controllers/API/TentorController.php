<?php

namespace App\Http\Controllers\API;

use App\DataMengajar;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\LogSaldo;
use Illuminate\Http\Request;
use App\Tentor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifBooking;


class TentorController extends Controller
{
    public function addInfoTentor(Request $request, $tentor)
    {

        try {
            $input['hobi'] = $request['hobi'];
            $input['motto'] = $request['motto'];
            // return response()->json(['success' => $tentor], 200);
            Tentor::where('id', $tentor)->update($input);
            return response()->json(['data' => 'Berhasil menambahkan data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized', 'pesan' => $th], 401);
        }
    }

    public function getInfoTentor($tentor)
    {
        try {
            $data = Tentor::join('users', 'users.id', 'data_tentor.id_akun')->where('data_tentor.id', $tentor)
                ->select('users.email', 'users.username', 'data_tentor.*')->first();
            return response()->json(['data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function jadwalReady($tentor)
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu', 'Minggu'];
        try {
            $data = Jadwal::leftjoin('kelas', 'kelas.id', 'jadwal.id_kelas')
                ->where('id_tentor', $tentor)
                ->select('hari')
                ->groupBy('hari')
                ->get();
            for ($i = 0; $i < count($data); $i++) {
                if (in_array($data[$i]['hari'], $hari)) {
                    $day = array_search($data[$i]['hari'], $hari);
                    unset($hari[$day]);
                    $hari = array_values($hari);
                }
            }
            return response()->json(['data' => $hari], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function getSaldo()
    {
        try {
            $as = Auth::user()->id;
            $tmp = Tentor::where('id_akun', $as)->select('id', 'saldo_dompet')->first();
            $log = LogSaldo::leftjoin('data_tentor as dt', 'dt.id', 'log_saldo.id_tentor')
                ->where('log_saldo.id_tentor', $tmp->id)
                ->select('dt.nama as tentor', 'log_saldo.*')
                ->get();
            $lg = array();
            $logP = [];
            foreach ($log as $key) {
                $lg['jumlah_saldo'] = $key->jumlah_saldo;
                $lg['keterangan'] = $key->keterangan;
                $lg['jenis'] = $key->jenis;
                $lg['created_at'] = date('Y-m-d H:i:s', strtotime($key->created_at));
                $logP[] = $lg;
            }


            $data = ['saldo' => $tmp, 'log' => $logP];
            return response()->json(['data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
        }
        # code...
    }

    public function addDataMengajar(Request $request)
    {
        $request->validate([
            'tentor' => 'required',
            'mapel' => 'required',
        ]);

        try {
            $input = $request->all();
            $input['id_mapel'] = $request['mapel'];
            $input['id_tentor'] = $request['tentor'];
            DataMengajar::create($input);
            return response()->json(['data' => 'Sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed'], 401);
        }
    }

    public function getListTentor($mapel)
    {
        $dataMengajar = DataMengajar::join('data_tentor as dt', 'dt.id', 'data_mengajar.id_tentor')->where('id_mapel', $mapel)->get();
        if ($dataMengajar) {
            return response()->json(['data' => $dataMengajar], 200);
        } else {
            return response()->json(['error' => 'Failed getting data'], 401);
        }
    }

    public function deleteDataMengajar($id)
    {
        try {
            DataMengajar::where('id', $id)->delete();
            return response()->json(['data' => 'Sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed'], 401);
        }
    }


}
