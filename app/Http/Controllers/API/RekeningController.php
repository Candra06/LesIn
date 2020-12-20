<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Rekening;

class RekeningController extends Controller
{
    public function index()
    {
        $data = Rekening::where('status', 'Aktif')->get();
        if ($data) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Gagal mengakses data'], 401);
        }

    }
}
