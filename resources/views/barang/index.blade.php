@extends('layouts.app')
@section('konten')
    <!-- Button trigger modal -->
    <button class="btn btn-primary bg-blue-600" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah
    </button>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga Pokok</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $e => $item)
                <tr>
                    <td>{{ $e + 1 }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->het }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-success btn-sm btn-flat">Edit</a>

                        <a href="{{ url('barang/delete/' . $item->id) }}" type="DELETE"
                            class="btn btn-danger btn-sm btn-flat"
                            onclick="return confirm ('Apakah Akan Anda Hapus?')">Hapus</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('kode_barang') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Kode Barang</label>
                            <input name="kode_barang" type="text" readonly class="form-control" id="inputnama"
                                placeholder="Input Kode Barang" value="{{ $kode }}">
                            @if ($errors->has('kode_barang'))
                                <span class="right badge-danger"
                                    class=" help-block">{{ $errors->first('kode_barang') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Nama Barang</label>
                            <input name="nama" type="text" class="form-control" id="inputnama"
                                placeholder="Input Nama Barang" value="{{ old('nama') }}">
                            @if ($errors->has('nama'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('nama') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('het') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Harga Pokok</label>
                            <input name="het" type="text" class="form-control" id="inputusername"
                                placeholder="Input Harga Beli" value="{{ old('het') }}">
                            @if ($errors->has('het'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('het') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('harga') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Harga Jual</label>
                            <input name="harga" type="text" class="form-control" id="inputusername"
                                placeholder="Input Harga Jual" value="{{ old('harga') }}">
                            @if ($errors->has('harga'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('harga') }}</span>
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
