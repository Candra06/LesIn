<?php

namespace App\Http\Controllers;

use App\Tentor;
use App\User;
use Illuminate\Http\Request;

class TentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tentor::all();
        return view('tentor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tentor.add');
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
            'nama' => 'required|max:45',
            'email' => 'required|max:45',
            'password' => 'required',
            'telepon' => 'required|max:13',
            'gender' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        $akun['email'] = $request['email'];
        $akun['password'] = bcrypt($request['password']);
        $akun['role'] = 'tentor';
        $addAkun = User::create($akun);

        $tentor['id_akun'] = $addAkun->id;
        $tentor['nama'] = $request['nama'];
        $tentor['telepon'] = $request['telepon'];
        $tentor['gender'] = $request['gender'];
        $tentor['tgl_lahir'] = $request['tgl_lahir'];
        $tentor['alamat'] = $request['alamat'];
        $tentor['motto'] = '-';
        $tentor['hobi'] = '-';
        $tentor['lattitude'] = '-';
        $tentor['longitude'] = '-';
        $tentor['saldo_dompet'] = 0;

        try {
            Tentor::create($tentor);
            return redirect('/tentor')->with('status', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            return redirect('/tentor/create')->with('status', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tentor  $tentor
     * @return \Illuminate\Http\Response
     */
    public function show(Tentor $tentor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tentor  $tentor
     * @return \Illuminate\Http\Response
     */
    public function edit(Tentor $tentor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tentor  $tentor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tentor $tentor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tentor  $tentor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tentor $tentor)
    {
        //
    }
}
