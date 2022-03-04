@extends('layouts.app')
@section('konten')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Button trigger modal -->
                    <form action="{{ url('barang/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input name="nama" type="text" class="form-control" id="inputnoinduk" placeholder="Input Nama"
                                value="{{ $data->nama }}">
                            @if ($errors->has('nama'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('nama') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('het') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Harga Pokok </label>
                            <input name="het" type="text" class="form-control" id="inputnoinduk"
                                placeholder="Input Harga Pokok" value="{{ $data->het }}">
                            @if ($errors->has('het'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('het') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('harga') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Harga Jual </label>
                            <input name="harga" type="text" class="form-control" id="inputnoinduk"
                                placeholder="Input Harga Jual" value="{{ $data->harga }}">
                            @if ($errors->has('harga'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('harga') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('jumlah') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Jumlah</label>
                            <input name="jumlah" type="text" class="form-control" id="inputnoinduk"
                                placeholder="Input Jumlah" value="{{ $data->jumlah }}">
                            @if ($errors->has('jumlah'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('jumlah') }}</span>
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
