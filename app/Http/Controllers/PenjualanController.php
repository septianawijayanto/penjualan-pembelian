<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getRow = Penjualan::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "NFT00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "NFT0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "NFT000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "NFT00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "NFT0" . '' . ($lastId->id + 1);
            } else {
                $kode = "NFT" . '' . ($lastId->id + 1);
            }
        }

        $header = 'Penjualan';
        $pelanggan = Pelanggan::get();
        $barang = Barang::where('jumlah', '>', 0)->get();
        $data = Penjualan::all();
        return view('penjualan.index', compact('header', 'data', 'kode', 'pelanggan', 'barang'));
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

        $dis = 10 / 100;
        $ppn = 10 / 100;
        $id_barang = $request->barang_id;
        $barang = Barang::find($id_barang);

        $jml = $barang->jumlah;
        $saiki = $jml - $request->jumlah;



        $harga = $barang->harga;

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
                Penjualan::create([
                    'no_faktur' => $request->no_faktur,
                    'barang_id' => $request->barang_id,
                    'pelanggan_id' => $request->pelanggan_id,
                    'jumlah' => $request->jumlah,
                    'tanggal' => $request->tanggal,
                    'diskon' => '10%',
                    'satuan' => $request->satuan,
                    'ppn' => '10%',
                    'ket' => $request->ket,
                    'subtotal' => $satu,

                ]);
            }
            //diskon dan ppn 0%
            elseif ($request->status == 2) {
                Penjualan::create([
                    'no_faktur' => $request->no_faktur,
                    'barang_id' => $request->barang_id,
                    'pelanggan_id' => $request->pelanggan_id,
                    'jumlah' => $request->jumlah,
                    'tanggal' => $request->tanggal,
                    'diskon' => '',
                    'satuan' => $request->satuan,
                    'ppn' => '',
                    'ket' => $request->ket,
                    'subtotal' => $total,

                ]);
            }
            //diskon 10% dan ppn 0%
            elseif ($request->status == 3) {
                Penjualan::create([
                    'no_faktur' => $request->no_faktur,
                    'barang_id' => $request->barang_id,
                    'pelanggan_id' => $request->pelanggan_id,
                    'jumlah' => $request->jumlah,
                    'satuan' => $request->satuan,
                    'tanggal' => $request->tanggal,
                    'diskon' => '10%',
                    'ppn' => '',
                    'ket' => $request->ket,
                    'subtotal' => $tiga,
                ]);
            }
            //diskon 0% dan ppn 10% 
            else {
                Penjualan::create([
                    'no_faktur' => $request->no_faktur,
                    'barang_id' => $request->barang_id,
                    'pelanggan_id' => $request->pelanggan_id,
                    'jumlah' => $request->jumlah,
                    'tanggal' => $request->tanggal,
                    'satuan' => $request->satuan,
                    'diskon' => '',
                    'ppn' => '10%',
                    'ket' => $request->ket,
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
    public function lunasi($id)
    {
        Penjualan::where('id', $id)->update(['status_pembayaran' => 'Lunas',]);
        return redirect()->back()->with('sukses', 'Pembayaran Berhasil');
    }
    public function invoice($id)
    {
        $tgl = date('d F Y');
        $data = Penjualan::findOrFail($id);
        $pdf = PDF::loadview('penjualan.invoice', compact('data', 'tgl'))->setPaper('a5', 'Potrait');
        return $pdf->stream();
    }
    public function cetakpdf()
    {
        $tgl = date('d F Y');
        $data = Penjualan::all();
        $pdf = PDF::loadview('penjualan.cetak', compact('data', 'tgl'))->setPaper('a4', 'Landscape');
        return $pdf->stream();
    }
}
