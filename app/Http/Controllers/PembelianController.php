<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PembelianController extends Controller
{

    public function index()
    {
        $getRow = Pembelian::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "LPB00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "LPB0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "LPB000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "LPB00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "LPB0" . '' . ($lastId->id + 1);
            } else {
                $kode = "LPB" . '' . ($lastId->id + 1);
            }
        }

        $header = 'Pembelian';
        $supplier = Supplier::get();
        $barang = Barang::where('jumlah', '>', 0)->get();
        $data = Pembelian::all();
        return view('pembelian.index', compact('header', 'data', 'kode', 'supplier', 'barang'));
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


        $dis = 10 / 100;
        $ppn = 10 / 100;
        $id_barang = $request->barang_id;
        $barang = Barang::find($id_barang);

        $jml = $barang->jumlah;
        $saiki = $jml - $request->jumlah;



        $harga = $barang->het;

        $jumlah = $request->jumlah;

        $total = $jumlah * $harga;

        $ppnsaiki = $ppn * $total;

        $diskonsaiki = $dis * $total;

        $sub = $total - $diskonsaiki;

        $satu = $sub + $ppnsaiki;

        $tiga = $total - $diskonsaiki;
        $empat = $total + $ppnsaiki;


        if ($jml >= $request->jumlah) {
            Barang::where('id', $id_barang)->update(['jumlah' => $saiki,]);

            //diskon dan ppn 10%
            if ($request->status == 1) {
                Pembelian::create([
                    'no_lpb' => $request->no_lpb,
                    'barang_id' => $request->barang_id,
                    'supplier_id' => $request->supplier_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '10%',
                    'ppn' => '10%',
                    'subtotal' => $satu,

                ]);
            }
            //diskon dan ppn 0%
            elseif ($request->status == 2) {
                Pembelian::create([
                    'no_lpb' => $request->no_lpb,
                    'barang_id' => $request->barang_id,
                    'supplier_id' => $request->supplier_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '',
                    'ppn' => '',

                    'subtotal' => $total,

                ]);
            }
            //diskon 10% dan ppn 0%
            elseif ($request->status == 3) {
                Pembelian::create([
                    'no_lpb' => $request->no_lpb,
                    'barang_id' => $request->barang_id,
                    'supplier_id' => $request->supplier_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '10%',
                    'ppn' => '',
                    'subtotal' => $tiga,
                ]);
            }
            //diskon 0% dan ppn 10% 
            else {
                Pembelian::create([
                    'no_lpb' => $request->no_lpb,
                    'barang_id' => $request->barang_id,
                    'supplier_id' => $request->supplier_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '',
                    'ppn' => '10%',
                    'subtotal' => $empat,
                ]);
            };
            return redirect()->back()->with('sukses', 'Data Berhasil Disimpan');
        } else {
            return redirect()->back()->with('gagal', 'Jumlah Barang Kurang');
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
        $header = 'Edit Pembelian';
        $supplier = Supplier::get();
        $barang = Barang::where('jumlah', '>', 0)->get();
        $data = Pembelian::find($id);
        return view('pembelian.edit', compact('header', 'supplier', 'barang', 'data'));
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
        $dis = 10 / 100;
        $ppn = 10 / 100;
        $id_barang = $request->barang_id;
        $barang = Barang::find($id_barang);

        $jml = $barang->jumlah;
        $saiki = $jml - $request->jumlah;



        $harga = $barang->het;

        $jumlah = $request->jumlah;

        $total = $jumlah * $harga;

        $ppnsaiki = $ppn * $total;

        $diskonsaiki = $dis * $total;

        $sub = $total - $diskonsaiki;

        $satu = $sub + $ppnsaiki;

        $tiga = $total - $diskonsaiki;
        $empat = $total + $ppnsaiki;


        if ($jml >= $request->jumlah) {
            Barang::where('id', $id_barang)->update(['jumlah' => $saiki,]);

            //diskon dan ppn 10%
            if ($request->status == 1) {
                Pembelian::create([
                    'no_lpb' => $request->no_lpb,
                    'barang_id' => $request->barang_id,
                    'supplier_id' => $request->supplier_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '10%',
                    'ppn' => '10%',
                    'subtotal' => $satu,

                ]);
            }
            //diskon dan ppn 0%
            elseif ($request->status == 2) {
                Pembelian::create([
                    'no_lpb' => $request->no_lpb,
                    'barang_id' => $request->barang_id,
                    'supplier_id' => $request->supplier_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '',
                    'ppn' => '',

                    'subtotal' => $total,

                ]);
            }
            //diskon 10% dan ppn 0%
            elseif ($request->status == 3) {
                Pembelian::create([
                    'no_lpb' => $request->no_lpb,
                    'barang_id' => $request->barang_id,
                    'supplier_id' => $request->supplier_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '10%',
                    'ppn' => '',
                    'subtotal' => $tiga,
                ]);
            }
            //diskon 0% dan ppn 10% 
            else {
                Pembelian::create([
                    'no_lpb' => $request->no_lpb,
                    'barang_id' => $request->barang_id,
                    'supplier_id' => $request->supplier_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '',
                    'ppn' => '10%',
                    'subtotal' => $empat,
                ]);
            };
            return redirect()->back()->with('sukses', 'Data Berhasil Disimpan');
        } else {
            return redirect()->back()->with('gagal', 'Jumlah Barang Kurang');
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

    public function cetak()
    {
        $tgl = date('d F Y');
        $data = Pembelian::all();
        $pdf = PDF::loadview('pembelian.cetak', compact('data', 'tgl'))->setPaper('a4', 'Landscape');
        return $pdf->stream();
    }
    public function delete($id)
    {
        $data = Pembelian::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('sukses', 'Data Berhasil Dihapus');
    }
}
