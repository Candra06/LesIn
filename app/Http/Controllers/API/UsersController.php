<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Siswa;
use App\Tentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
   public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'telepon' => 'required',
            'username' => 'required',
            'gender' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);
        $role = User::where('id', $id)->first();
        try {
            $data['nama'] = $request['nama'];
            $data['telepon'] = $request['telepon'];
            $data['gender'] = $request['gender'];
            $data['tgl_lahir'] = $request['tgl_lahir'];
            $data['alamat'] = $request['alamat'];
            $akun['email'] = $request['email'];
            $akun['username'] = $request['username'];
            $akun['password'] =  bcrypt($request['password']);
            User::where('id', $id)->update($akun);
            if ($role->role == "siswa") {
                Siswa::where('id_akun', $id)->update($data);
            } else {
                $data['hobi'] = $request['hobi'];
                $data['motto'] = $request['motto'];
                Tentor::where('id_akun', $id)->update($data);
            }
            return response()->json(['data' => 'Sukses'], $this->successStatus);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Failed', 'message' => $th], 401);
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

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        // dd($password);
        // return $request;
        $data = User::where('username',$username)->first();
        if($data){
            if(password_verify($password, $data->password)){
                $success['token'] =  $data->createToken('nApp')->accessToken;
                return response()->json(['data' => $success], $this->successStatus);
            }else{
                return response()->json(['error' => bcrypt($password)], 401);
            }
        }
        else{
            return response()->json(['error' => 'Email Salah'], 401);
        }

    }

    public function profil()
    {
        $user = Auth::user()->id;
        $role =  Auth::user()->role;

        if ($role == "siswa") {
            $data = Siswa::join('users', 'users.id', 'data_siswa.id_akun')->where('data_siswa.id_akun', $user)->select('data_siswa.*', 'users.role', 'users.email','users.username')->first();
        } else {
            $data = Tentor::join('users', 'users.id', 'data_tentor.id_akun')->where('data_tentor.id_akun', $user)->select('data_tentor.*', 'users.role', 'users.email','users.username')->first();
        }

        return response()->json(['data' => $data], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        if (!$request->role) {
            $akun['role'] = "siswa";
        } else {
            $akun['role'] = $request['role'];
        }

        $akun['email'] = $request['email'];
        $akun['username'] = $request['username'];
        $akun['password'] = bcrypt($request['password']);
        $users = User::create($akun);
        $idAkun = $users->id;
        if ( $akun['role'] == "siswa") {
            $data['nama'] = $request['nama'];
            $data['telepon'] = $request['telepon'];
            $data['gender'] = $request['gender'];
            $data['tgl_lahir'] = $request['tgl_lahir'];
            $data['alamat'] = $request['alamat'];
            $data['id_akun'] = $idAkun;
            Siswa::create($data);
        } else {
            $data['nama'] = $request['nama'];
            $data['telepon'] = $request['telepon'];
            $data['gender'] = $request['gender'];
            $data['tgl_lahir'] = $request['tgl_lahir'];
            $data['alamat'] = $request['alamat'];
            $data['id_akun'] = $idAkun;
            $data['motto'] = 'Live is never flat';
            $data['saldo_dompet'] = 0;
            $data['lattitude'] = 0;
            $data['longitude'] = 0;
            // return $data;
            Tentor::create($data);
        }

        if ($users) {
            return response()->json(['data' => 'Berhasil menambahkan data'], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

}
