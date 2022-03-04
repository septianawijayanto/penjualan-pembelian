<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getRow = Pelanggan::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "PEL00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "PEL0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "PEL000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "PEL00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "PEL0" . '' . ($lastId->id + 1);
            } else {
                $kode = "PEL" . '' . ($lastId->id + 1);
            }
        }

        $header = 'Pelanggan';
        $data = Pelanggan::all();
        return view('pelanggan.index', compact('header', 'data', 'kode'));
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
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
            'nama_kategori.required' => 'Nama Kategori Wajib di Isi',
        ];
        //dd($request->all());
        $this->validate($request, [
            'nama_pelanggan' => 'required|max:60',
            'jk' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ], $messages);

        Pelanggan::create($request->all());
        return redirect()->back()->with('sukses', 'Data Berahsil Disimpan');
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
        $header = 'Edit Pelanggan';
        $data = Pelanggan::find($id);
        return view('pelanggan.edit', compact('header', 'data'));
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
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
            'nama_kategori.required' => 'Nama Kategori Wajib di Isi',
        ];
        //dd($request->all());
        $this->validate($request, [
            'nama_pelanggan' => 'required|max:60',
            'jk' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ], $messages);
        $data = Pelanggan::find($id);
        $data->update($request->all());
        return redirect('/pelanggan')->with('sukses', 'Data Berhasil Diupdate');
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
    public function delete($id)
    {
        $data = Pelanggan::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('sukses', 'Data Berhasil Dihapus');
    }
}
