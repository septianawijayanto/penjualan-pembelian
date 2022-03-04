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
                <th scope="col">Kode Pelanggan</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">No Telpon</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $e => $item)
                <tr>
                    <td>{{ $e + 1 }}</td>
                    <td>{{ $item->kode_pelanggan }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->jk }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-success btn-sm btn-flat">Edit</a>

                        <a href="{{ url('pelanggan/delete/' . $item->id) }}" type="DELETE"
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
                    <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('kode_pelanggan') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Kode pelanggan</label>
                            <input name="kode_pelanggan" type="text" readonly class="form-control" id="inputnama"
                                placeholder="Input Kode pelanggan" value="{{ $kode }}">
                            @if ($errors->has('kode_pelanggan'))
                                <span class="right badge-danger"
                                    class=" help-block">{{ $errors->first('kode_pelanggan') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nama_pelanggan') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Nama pelanggan</label>
                            <input name="nama_pelanggan" type="text" class="form-control" id="inputnama"
                                placeholder="Input Nama pelanggan" value="{{ old('nama_pelanggan') }}">
                            @if ($errors->has('nama_pelanggan'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('nama_pelanggan') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('jk') ? 'has-error' : '' }}">
                            <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                            <select name="jk" class="form-control" id="exampleFormControlSelect1">
                                <option value="">-Pilih-</option>
                                <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @if ($errors->has('jk'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('jk') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('no_telp') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">No Telpon</label>
                            <input name="no_telp" type="text" class="form-control" id="inputusername"
                                placeholder="Input No Telpon" value="{{ old('no_telp') }}">
                            @if ($errors->has('no_telp'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('no_telp') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Alamat</label>
                            <input name="alamat" type="text" class="form-control" id="inputusername"
                                placeholder="Input Alamat" value="{{ old('alamat') }}">
                            @if ($errors->has('alamat'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('stok') }}</span>
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
