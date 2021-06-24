<?php

namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mapel::all();
        return view('mapel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'mapel' => 'required',
            'tingkatan' => 'required',
            'kelas' => 'required',
            'status' => 'required',
        ]);
        try {

            $input['mapel'] = $request['mapel'];
            $input['jenjang'] = $request['tingkatan'];
            $input['kelas'] = $request['kelas'];
            $input['status'] = $request['status'];
            // return $input;
            Mapel::create($input);
            return redirect('/mapel')->with('status', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            // return $th;
            return redirect('/mapel/create')->with('status', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'mapel' => 'required',
            'tingkatan' => 'required',
            'kelas' => 'required',
            'status' => 'required',
        ]);

        try {

            $input['mapel'] = $request['mapel'];
            $input['jenjang'] = $request['tingkatan'];
            $input['kelas'] = $request['kelas'];
            $input['status'] = $request['status'];

            Mapel::where('id',$mapel->id)->update($input);
            return redirect('/mapel')->with('status', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            // return $th;
            return redirect('/mapel/'.$mapel->id.'/edit')->with('status', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        //
    }
}
