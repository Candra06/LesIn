<?php

namespace App\Http\Controllers\API;

use App\Feedback;
use App\Http\Controllers\Controller;
use App\Tentor;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function simpan(Request $request)
    {
        $in = [
            'id_kelas' => $request['id_kelas'],
            'id_tentor' => $request['id_tentor'],
            'id_siswa' => $request['id_siswa'],
            'feedback' => $request['feedback'],
            'rating' => $request['rating'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $rate = Feedback::where('id_tentor', $request['id_tentor'])->avg('rating');
        if ($rate) {
            Tentor::where('id', $request['id_tentor'])->update(['rating' => $rate]);
            # code...
        } else {
            Tentor::where('id', $request['id_tentor'])->update(['rating' => $request['rating']]);
        }

        // return $rate;
        try {
            Feedback::create($in);
            return response()->json(['data' => 'Sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
        }
    }
}
