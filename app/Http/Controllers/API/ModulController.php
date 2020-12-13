<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas)
    {
        $data = Modul::where('id_kelas', $kelas)->get();
        if ($data) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'Failed load'], 401);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => 'max:50|required',
                'id_kelas' => 'required',
                'id_tentor' => 'required',
                'materi' => 'required',
                'file' => 'file|max:10000|mimes:doc,docx,pdf'
            ]
        );
        $fileType = $request->file('file')->extension();
        $name =  Str::random(8) . '.' . $fileType;
        $input['judul'] = $request['judul'];
        $input['id_kelas'] = $request['id_kelas'];
        $input['id_tentor'] = $request['id_tentor'];
        $input['materi'] = $request['materi'];
        $input['file'] = Storage::putFileAs('file_modul', $request->file('file'), $name);

        try {
            Modul::create($input);
            return response()->json(['data' => 'Berhasil'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
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
