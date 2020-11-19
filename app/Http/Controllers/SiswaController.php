<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Siswa::all();
        return view('siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'telepon' => 'required',
            'whatsapp' => 'required',
            'alamat' => 'required',
            'gender' => 'required',
            'tglLahir' => 'required',
        ]);
        try {
            $akun['email'] = $request['email'];
            $akun['password'] = bcrypt($request['email']);
            $akunSiswa = User::create($akun);
            $siswa['id_akun'] = $akunSiswa->id;
            $siswa['nama'] = $request['nama'];
            $siswa['telepon'] = $request['telepon'];
            $siswa['wa'] = $request['whatsapp'];
            $siswa['alamat'] = $request['alamat'];
            $siswa['gender'] = $request['gender'];
            $siswa['tgl_lahir'] = $request['tglLahir'];
            Siswa::create($siswa);
            return redirect('/siswa')->with('status', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            return redirect('/siswa/create')->with('status', 'Gagal menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return $id;
        $data = Siswa::join('users', 'users.id', 'data_siswa.id_akun')
        ->where('data_siswa.id', $id)
        ->select('data_siswa.*', 'users.email')->first();
        return view('siswa.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $siswa)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'gender' => 'required',
            'tglLahir' => 'required',
            'status' => 'required',
        ]);

        try {
            $idAkun = Siswa::where('id', $siswa)->select('id_akun')->first();
            $akun['email'] = $request['email'];
            $akun['password'] = bcrypt($request['email']);
            User::where('id', $idAkun->id_akun);

            $update['nama'] = $request['nama'];
            $update['telepon'] = $request['telepon'];
            $update['alamat'] = $request['alamat'];
            $update['gender'] = $request['gender'];
            $update['status'] = $request['status'];
            $update['tgl_lahir'] = $request['tglLahir'];
            Siswa::where('id',$siswa)->update($update);
            return redirect('/siswa')->with('status', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            return $th;
            return redirect('/siswa/'.$siswa.'/edit')->with('status', 'Gagal mengubah data');
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

    public function siswaById()
    {
        # code...
    }
}
