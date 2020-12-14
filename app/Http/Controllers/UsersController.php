<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Rekening;
use App\Siswa;
use App\Tentor;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        return view('login');
    }

    public function dashboard()
    {
        // $data =
        $siswa = Siswa::count();
        $tentor = Tentor::count();
        $kelas = Kelas::count();
        $saldo = Rekening::sum('saldo');
        return view('dashboard.index', compact('siswa', 'tentor', 'kelas', 'saldo'));
    }

    public function login(Request $request)
    {

        $data = User::where('email', $request->username)->first();
        if ($data) {
            if ($data->role != 'admin') {
                return redirect('/')->with('message', 'Anda bukan admin!');
            } else {
                if (password_verify($request->password, $data->password)) {
                    session()->put('login', true);
                    session()->put('email', $data->email);
                    session()->put('nama', $data->nama);
                    session()->put('username', $data->username);
                    session()->put('id', $data->id);
                    return redirect('dashboard');
                } else {
                    return redirect('/')->with('message', 'Password salah!');
                }
            }

        } else {
            return redirect('/')->with('message', 'Email tidak teredaftar!');
        }

    }

    public function logout(Request $request)
    {
        $request->session()->flash('login', 0);
        return redirect('/')->with('message', 'Berhasil Logout');
    }

    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


}
