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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'telepon' => 'required',
            'wa' => 'required',
            'gender' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);
        $role = User::where('id', $id)->first();
        try {
            $data['nama'] = $request['nama'];
            $data['telepon'] = $request['telepon'];
            $data['wa'] = $request['wa'];
            $data['gender'] = $request['gender'];
            $data['tgl_lahir'] = $request['tgl_lahir'];
            $data['alamat'] = $request['alamat'];
            $akun['email'] = $request['email'];
            $akun['password'] =  bcrypt($request['password']);
            User::where('id', $id)->update($akun);
            if ($role->role == "siswa") {
                Siswa::where('id_akun', $id)->update($data);
            } else {
                Tentor::where('id_akun', $id)->update($data);
            }
            return response()->json(['success' => 'Sukses'], $this->successStatus);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Failed'], 401);
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
        $email = $request->email;
        $password = $request->password;
        // dd($password);
        $data = User::where('email',$email)->first();
        if($data){
            if(password_verify($password, $data->password)){
                $success['token'] =  $data->createToken('nApp')->accessToken;
                return response()->json(['success' => $success], $this->successStatus);
            }else{
                return response()->json(['error' => bcrypt($password)], 401);
            }
        }
        else{
            return response()->json(['error' => 'Email Salah'], 401);
        }

    }

    public function details()
    {
        $user = Auth::user()->id;
        $role =  Auth::user()->role;
        if ($role == "siswa") {
            $data = Siswa::join('users', 'users.id', 'data_siswa.id_akun')->where('data_siswa.id_akun', $user)->select('data_siswa.*', 'users.role')->first();
        } else {
            $data = Tentor::join('users', 'users.id', 'data_tentor.id_akun')->where('data_tentor.id_akun', $user)->select('data_tentor.*', 'users.role')->first();
        }

        return response()->json(['success' => $data], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'telepon' => 'required',
            'wa' => 'required',
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
        $akun['password'] = bcrypt($request['password']);
        $users = User::create($akun);
        $idAkun = $users->id;
        if ( $akun['role'] == "siswa") {
            $data['nama'] = $request['nama'];
            $data['telepon'] = $request['telepon'];
            $data['wa'] = $request['wa'];
            $data['gender'] = $request['gender'];
            $data['tgl_lahir'] = $request['tgl_lahir'];
            $data['alamat'] = $request['alamat'];
            $data['id_akun'] = $idAkun;
            Siswa::create($data);
        } else {
            $data['nama'] = $request['nama'];
            $data['telepon'] = $request['telepon'];
            $data['wa'] = $request['wa'];
            $data['gender'] = $request['gender'];
            $data['tgl_lahir'] = $request['tgl_lahir'];
            $data['alamat'] = $request['alamat'];
            $data['id_akun'] = $idAkun;
            $data['motto'] = 'Live is never flat';
            $data['saldo_dompet'] = 0;
            // return $data;
            Tentor::create($data);
        }

        if ($users) {
            return response()->json(['success' => 'Berhasil menambahkan data'], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

}
