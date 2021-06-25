<?php

namespace App\Http\Controllers\API;

use App\Chat;
use App\Http\Controllers\Controller;
use App\Mail\NotifBooking;
use App\RoomChat;
use App\Siswa;
use App\Tentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    public function listChat()
    {
        $as = Auth::user()->id;
        $role = Auth::user()->role;
        // return $as . ' ' .$role;
        if ($role == 'siswa') {
            $id = Siswa::where('id_akun', $as)->select('id')->first();
            $var = RoomChat::where('created_by', $id->id)
                ->orWhere('receiver', $id->id)
                ->select('id')
                ->get();
            // return $var;
            $data = array();
            foreach ($var as $v) {
                $data[] = Chat::join('data_tentor as dt', 'dt.id', 'detail_chat.id_tentor')
                    ->where('id_room', $v->id)
                    ->select('detail_chat.message', 'detail_chat.created_at', 'dt.nama', 'detail_chat.id_room', 'detail_chat.status')
                    ->orderBy('created_at', 'DESC')->first();
            }
            // return $data;
            $tmp = array();
            foreach ($data as $key) {
                $tmp['message'] = $key->message;
                $tmp['created_at'] =  date('Y-m-d H:i:s', strtotime($key->message));
                $tmp['nama'] = $key->nama;
                $tmp['id_room'] = $key->id_room;
                $tmp['status'] = $key->status;
                $pesan[] = $tmp;
            }

        } else {
            $id = Tentor::where('id_akun', $as)->select('id')->first();
            $var = RoomChat::where('created_by', $id->id)
                ->orWhere('receiver', $id->id)
                ->select('id')
                ->get();
            $data = array();
            foreach ($var as $v) {
                $data[] = Chat::join('data_siswa as ds', 'ds.id', 'detail_chat.id_siswa')
                    ->where('id_room', $v->id)
                    ->select('detail_chat.message', 'detail_chat.created_at', 'ds.nama', 'detail_chat.id_room', 'detail_chat.status')
                    ->orderBy('created_at', 'DESC')->first();
            }
            $tmp = array();
            foreach ($data as $key) {
                $tmp['message'] = $key->message;
                $tmp['created_at'] =  date('Y-m-d H:i:s', strtotime($key->message));
                $tmp['nama'] = $key->nama;
                $tmp['id_room'] = $key->id_room;
                $tmp['status'] = $key->status;
                $pesan[] = $tmp;
            }
        }

        try {

            return response()->json(['data' => $pesan], 200);
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
                $idRoom = $cek->id;
                $detail['id_room'] = $cek->id;
                $detail['id_siswa'] = $request['id_siswa'];
                $detail['id_tentor'] = $request['id_tentor'];
                $detail['message'] = $request['message'];
                $detail['created_by'] = $request['created_by'];
                $detail['status'] = 'Diterima';
                $detail['created_at'] = date('Y-m-d H:i:s');
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
                $detail['created_by'] = $request['created_by'];
                $detail['status'] = 'Diterima';
                $detail['created_at'] = date('Y-m-d H:i:s');
                Chat::create($detail);
            }
            $name = Siswa::where('id',  $request['id_siswa'])->select('nama')->first();
            $tentor = Tentor::leftJoin('users', 'users.id', 'data_tentor.id_akun')->where('data_tentor.id',  $request['id_tentor'])->select('email')->first();
            // Mail::to([$tentor->email])->send(new NotifBooking($name->nama));
            return response()->json(['data' => 'Sukses', 'room' => $idRoom], 200);
        } catch (\Throwable $th) {
            return $th;
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
