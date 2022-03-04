@extends('layouts.app')
@section('konten')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Button trigger modal -->
                    <form action="{{ url('pelanggan/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group {{ $errors->has('nama_pelanggan') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Nama Nama Pelanggan</label>
                            <input name="nama_pelanggan" type="text" class="form-control" id="inputnoinduk"
                                placeholder="Input Nama Nama Pelanggan" value="{{ $data->nama_pelanggan }}">
                            @if ($errors->has('nama_pelanggan'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('nama_pelanggan') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('jk') ? 'has-error' : '' }}">
                            <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                            <select name="jk" class="form-control" id="exampleFormControlSelect1">
                                <option value="">-Pilih-</option>
                                <option value="L" @if ($data->jk == 'L') selected @endif>Laki-Laki
                                </option>
                                <option value="P" @if ($data->jk == 'P') selected @endif>Perempuan
                                </option>
                            </select>
                            @if ($errors->has('jk'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('jk') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('no_telp') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">NO Telpon</label>
                            <input name="no_telp" type="text" class="form-control" id="inputnoinduk"
                                placeholder="Input NO Telpon" value="{{ $data->no_telp }}">
                            @if ($errors->has('no_telp'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('no_telp') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Alamat</label>
                            <input name="alamat" type="text" class="form-control" id="inputnoinduk"
                                placeholder="Input Alamat" value="{{ $data->alamat }}">
                            @if ($errors->has('alamat'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('alamat') }}</span>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="submit" style="background-color: blue" class="btn btn-primary"><i
                                    class="fa fa-save"></i>
                                Update</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
