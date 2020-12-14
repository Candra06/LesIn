<?php

namespace App\Http\Controllers;

use App\LogSaldo;
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
        $data = Tentor::join('users', 'users.id', 'data_tentor.id_akun')->select('data_tentor.*', 'users.username')->get();
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
            'username' => 'required',
        ]);

        $akun['email'] = $request['email'];
        $akun['username'] = $request['username'];
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
        $tentor = Tentor::join('users', 'users.id', 'data_tentor.id_akun')->where('data_tentor.id', $tentor->id)->select('users.email', 'users.username', 'data_tentor.*')->first();
        return view('tentor.show', compact('tentor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tentor  $tentor
     * @return \Illuminate\Http\Response
     */
    public function edit(Tentor $tentor)
    {
        $tentor = Tentor::join('users', 'users.id', 'data_tentor.id_akun')->where('data_tentor.id', $tentor->id)->select('users.email', 'users.username', 'data_tentor.*')->first();
        return view('tentor.edit', compact('tentor'));
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
        $request->validate([
            'nama' => 'required|max:45',
            'email' => 'required|max:45',
            'password' => 'required',
            'telepon' => 'required|max:13',
            'gender' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'username' => 'required',
        ]);

        $akun['email'] = $request['email'];
        $akun['username'] = $request['username'];
        $akun['password'] = bcrypt($request['password']);
        $akun['role'] = 'tentor';
        $addAkun = User::create($akun);

        $updt['id_akun'] = $addAkun->id;
        $updt['nama'] = $request['nama'];
        $updt['telepon'] = $request['telepon'];
        $updt['gender'] = $request['gender'];
        $updt['tgl_lahir'] = $request['tgl_lahir'];
        $updt['alamat'] = $request['alamat'];
        $updt['motto'] = '-';
        $updt['hobi'] = '-';
        $updt['lattitude'] = '-';
        $updt['longitude'] = '-';
        $updt['saldo_dompet'] = 0;

        try {
            Tentor::where('id', $tentor->id)->update($updt);
            return redirect('/tentor')->with('status', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            return redirect('/tentor/' . $tentor->id . '/edit')->with('status', $th);
        }
    }

    public function listTentor()
    {
        $data = Tentor::all();
        return view('tentor.listTentor', compact('data'));
    }

    public function pencairan($tentor)
    {
        $data = Tentor::where('id', $tentor)->first();
        return view('tentor.pencairan', compact('data'));
    }

    public function pencairanSaldo(Request $request, $tentor)
    {

        $request->validate([
            'nominal' => 'required|numeric',
            'keterangan' => 'required|max:60',
        ]);
        if (intval($request['saldo']) < intval($request['nominal'])) {
            return redirect('/pencairan/' . $tentor .'/')->with('status', 'Saldo tidak mencukupi');
        }

        $new = intval($request['saldo']) - intval($request['nominal']);
        // return $new;
        $update = [
            'saldo_dompet' => $new,
            'updated_at' => date(''),
        ];

        $log = [
            'id_tentor' => $tentor,
            'jumlah_saldo' => intval($request['nominal']),
            'jenis' => 'Kredit',
            'keterangan' => 'Penarikan ' . $request['keterangan'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        try {
            Tentor::where('id', $tentor)->update($update);
            LogSaldo::create($log);
            return redirect('/gajiTentor')->with('status', 'Berhasil melakukan penarikan dana');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/pencairan/' . $tentor .'/')->with('status', $th);
        }
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
