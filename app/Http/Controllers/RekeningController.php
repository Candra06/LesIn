<?php

namespace App\Http\Controllers;

use App\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rekening::all();
        return view('rekening.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rekening.add');
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
            'nomor_rekening' => 'required',
            'bank' => 'required',
            'nama_rekening' => 'required',
            'saldo' => 'required|numeric',
            'status' => 'required',
        ]);

        $input['nomor_rekening']= $request['nomor_rekening'];
        $input['bank']= $request['bank'];
        $input['nama_rekening']= $request['nama_rekening'];
        $input['saldo']= $request['saldo'];
        $input['status']= $request['status'];
        $input['created_at']= date('Y-m-d H:i:s');
        try {
            Rekening::create($input);
            return redirect('/rekening')->with('status', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            return $th;
            return redirect('/rekening/create')->with('status', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function show(Rekening $rekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekening $rekening)
    {
        return view('rekening.edit', compact('rekening'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekening $rekening)
    {
        $request->validate([
            'nomor_rekening' => 'required',
            'bank' => 'required',
            'nama_rekening' => 'required',
            'saldo' => 'required|numeric',
        ]);

        $update['nomor_rekening']= $request['nomor_rekening'];
        $update['bank']= $request['bank'];
        $update['nama_rekening']= $request['nama_rekening'];
        $update['saldo']= $request['saldo'];
        $update['status']= $request['status'];
        $update['created_at']= date('Y-m-d H:i:s');
        try {
            Rekening::where('id', $rekening->id)->update($update);
            return redirect('/rekening')->with('status', 'Berhasil mwngubah data');
        } catch (\Throwable $th) {
            return redirect('/rekening/'.$rekening->id.'/edit')->with('status', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        //
    }
}
