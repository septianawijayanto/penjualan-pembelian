<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getRow = Barang::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "BAR00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "BAR0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "BAR000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "BAR00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "BAR0" . '' . ($lastId->id + 1);
            } else {
                $kode = "BAR" . '' . ($lastId->id + 1);
            }
        }

        $header = 'Barang';
        $supplier = Supplier::get();
        $data = Barang::all();
        return view('barang.index', compact('header', 'data', 'kode', 'supplier'));
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
            'nama' => 'required|max:60',
            'het' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
        ], $messages);

        Barang::create($request->all());
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
        $header = 'Edit Barang';
        $supplier = Supplier::get();
        $data = Barang::find($id);
        return view('barang.edit', compact('header', 'data', 'supplier'));
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
            'nama' => 'required|max:60',
            'het' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
        ], $messages);

        $data = Barang::find($id);
        $data->update($request->all());
        return redirect('/barang')->with('sukses', 'Data Berhasil Diupdate');
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
        $data = Barang::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('sukses', 'Data Berhasil Dihapus');
    }
}
