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
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
