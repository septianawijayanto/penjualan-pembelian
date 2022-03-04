@extends('layouts.app')
@section('konten')
    <!-- Button trigger modal -->
    <button class="btn btn-primary bg-blue-600" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah
    </button>
    <a href="{{ url('pembelian/cetak/pdf') }}" class="btn btn-warning">Cetak Laporan Pdf</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">No LPB</th>
                <th scope="col">Nama Suppli</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Diskon</th>
                <th scope="col">PPN</th>
                <th scope="col">Sub Total</th>
                {{-- <th scope="col">Status Pembayaran</th> --}}

                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $e => $item)
                <tr>
                    <td>{{ $e + 1 }}</td>
                    <td>{{ $item->no_lpb }}</td>
                    <td>{{ $item->supplier->nama_supplier }}</td>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->diskon }}</td>
                    <td>{{ $item->ppn }}</td>
                    <td>{{ $item->subtotal }}</td>
                    <td>
                        <a href="{{ route('pembelian.edit', $item->id) }}"
                            class="btn btn-success btn-sm btn-flat">Edit</a>

                        <a href="{{ url('pembelian/delete/' . $item->id) }}" type="DELETE"
                            class="btn btn-danger btn-sm btn-flat"
                            onclick="return confirm ('Apakah Akan Anda Hapus?')">Hapus</a>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('no_lpb') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">No Faktur</label>
                            <input name="no_lpb" type="text" readonly class="form-control" id="inputnama"
                                placeholder="Input No Faktur" value="{{ $kode }}">
                            @if ($errors->has('no_lpb'))
                                <span class="right badge-danger"
                                    class=" help-block">{{ $errors->first('no_lpb') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : '' }}">
                            <label for="supplier_id">Supplier</label>
                            <select name="supplier_id" class="form-control" id="supplier_id" require>
                                <option value="">-Pilih-</option>
                                @foreach ($supplier as $sp)
                                    <option value="{{ $sp->id }}">{{ $sp->nama_supplier }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('supplier_id'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('supplier_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('barang_id') ? 'has-error' : '' }}">
                            <label for="barang_id">Barang</label>
                            <select name="barang_id" class="form-control" id="barang_id" require>
                                <option value="">-Pilih-</option>
                                @foreach ($barang as $sp)
                                    <option value="{{ $sp->id }}">{{ $sp->nama }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('barang_id'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('barang_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('satuan') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Satuan</label>
                            <input name="satuan" type="text" class="form-control" id="inputnama"
                                placeholder="Input Satuan" value="{{ old('satuan') }}">
                            @if ($errors->has('satuan'))
                                <span class="right badge-danger"
                                    class=" help-block">{{ $errors->first('satuan') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('jumlah') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Jumlah</label>
                            <input name="jumlah" type="text" class="form-control" id="inputusername"
                                placeholder="Input Jumlah" value="{{ old('jumlah') }}">
                            @if ($errors->has('jumlah'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('jumlah') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('tanggal') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Tanggal</label>
                            <input name="tanggal" type="date" class="form-control" id="inputusername"
                                placeholder="Input Harga" value="{{ old('tanggal') }}">
                            @if ($errors->has('tanggal'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('tanggal') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label for="exampleFormControlSelect1">Pilih Diskon dan PPN</label>
                            <select name="status" class="form-control" id="exampleFormControlSelect1">
                                <option value="">-Pilih-</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                    Diskon dan PPN 10 %</option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>
                                    Diskon dan PPN 0%</option>
                                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>
                                    Diskon 10% dan PPN 0%</option>
                                <option value="4" {{ old('status') == '4' ? 'selected' : '' }}>
                                    Diskon 0% dan PPN 10%</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" style="background-color: red" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" style="background-color: blue" class="btn btn-primary"><i
                                    class="fa fa-save"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
