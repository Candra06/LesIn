<?php

namespace App\Http\Controllers\API;

use App\Chat;
use App\Http\Controllers\Controller;
use App\RoomChat;
use App\Siswa;
use App\Tentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function listChat($user)
    {
        $as = Auth::user()->id;
        $role = Auth::user()->role;

        $id = Siswa::where('id_akun', $as)->select('id')->first();
        $var = RoomChat::where('created_by', $id->id)
            ->select('id')
            ->get();
        $data = array();
        foreach ($var as $v) {
            $data[] = Chat::join('data_tentor as dt', 'dt.id', 'detail_chat.id_tentor')
                ->where('id_room', $v->id)
                ->select('detail_chat.message', 'detail_chat.created_at', 'dt.nama', 'detail_chat.id_room', 'detail_chat.status')
                ->orderBy('created_at', 'DESC')->first();
        }
        return response()->json(['data' => $data], 200);
        if ($role == 'siswa') {
            $id = Siswa::where('id_akun', $as)->select('id')->first();
            $var = RoomChat::where('created_by', $id->id)
                ->select('id')
                ->get();
            $data = array();
            foreach ($var as $v) {
                $data[] = Chat::join('data_tentor as dt', 'dt.id', 'detail_chat.id_tentor')
                    ->where('id_room', $v->id)
                    ->select('detail_chat.message', 'detail_chat.created_at', 'dt.nama', 'detail_chat.id_room', 'detail_chat.status')
                    ->orderBy('created_at', 'DESC')->first();
            }
        } else {
            $id = Tentor::where('id_akun', $as)->select('id')->first();
            $var = RoomChat::where('created_by', $id->id)
                ->select('id')
                ->get();
            $data = array();
            foreach ($var as $v) {
                $data[] = Chat::join('data_siswa as ds', 'ds.id', 'detail_chat.id_siswa')
                    ->where('id_room', $v->id)
                    ->select('detail_chat.message', 'detail_chat.created_at', 'ds.nama', 'detail_chat.id_room', 'detail_chat.status')
                    ->orderBy('created_at', 'DESC')->first();
            }
        }

        try {

            return response()->json(['data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
        }
    }

    public function createChat(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_tentor' => 'required',
            'message' => 'required',
        ]);

        $cek = RoomChat::where('created_by', $request['id_siswa'])->where('receiver',  $request['id_tentor'])->first();
        try {
            if ($cek) {
                $detail['id_room'] = $cek->id;
                $detail['id_siswa'] = $request['id_siswa'];
                $detail['id_tentor'] = $request['id_tentor'];
                $detail['message'] = $request['message'];
                $detail['status'] = 'Diterima';
                Chat::create($detail);
            } else {
                $room['created_by'] = $request['id_siswa'];
                $room['receiver'] = $request['id_tentor'];
                $addRoom = RoomChat::create($room);
                $idRoom = $addRoom->id;
                $detail['id_room'] = $idRoom;
                $detail['id_siswa'] = $request['id_siswa'];
                $detail['id_tentor'] = $request['id_tentor'];
                $detail['message'] = $request['message'];
                $detail['status'] = 'Diterima';
                Chat::create($detail);
            }
            return response()->json(['data' => 'Sukses'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
        }
    }

    public function detailChat($room)
    {
        try {
            $data = Chat::where('id_room', $room)->get();
            return response()->json(['data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
        }
    }
}
