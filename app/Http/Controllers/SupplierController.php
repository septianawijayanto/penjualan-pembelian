<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getRow = Supplier::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "SUP00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "SUP0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "SUP000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "SUP00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "SUP0" . '' . ($lastId->id + 1);
            } else {
                $kode = "SUP" . '' . ($lastId->id + 1);
            }
        }

        $header = 'Supplier';
        $data = Supplier::all();
        return view('supplier.index', compact('header', 'data', 'kode'));
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
            'nama_supplier' => 'required|max:60',
            'jk' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ], $messages);

        Supplier::create($request->all());
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
        $header = 'Edit Supplier';
        $data = Supplier::find($id);
        return view('supplier.edit', compact('header', 'data'));
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
            'nama_supplier' => 'required|max:60',
            'jk' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ], $messages);
        $data = Supplier::find($id);
        $data->update($request->all());
        return redirect('/supplier')->with('sukses', 'Data Berhasil Diupdate');
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
        $data = Supplier::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('sukses', 'Data Berhasil Dihapus');
    }
}
