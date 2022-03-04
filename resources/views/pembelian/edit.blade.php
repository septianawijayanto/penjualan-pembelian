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
                        <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : '' }}">
                            <label for="supplier_id">Supplier</label>
                            <select name="supplier_id" class="form-control" id="supplier_id" require>
                                <option value="">-Pilih-</option>
                                @foreach ($supplier as $sp)
                                    <option value="{{ $sp->id }}" @if ($sp->id === $data->supplier_id) selected @endif>
                                        {{ $sp->nama_supplier }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('supplier_id'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('supplier_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('barang_id') ? 'has-error' : '' }}">
                            <label for="barang_id">Supplier</label>
                            <select name="barang_id" class="form-control" id="barang_id" require>
                                <option value="">-Pilih-</option>
                                @foreach ($barang as $br)
                                    <option value="{{ $br->id }}" @if ($br->id === $data->barang_id) selected @endif>
                                        {{ $br->nama }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('barang_id'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('barang_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('satuan') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Satuan</label>
                            <input name="satuan" type="text" class="form-control" id="inputnoinduk"
                                placeholder="Input Satuan" value="{{ $data->satuan }}">
                            @if ($errors->has('satuan'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('satuan') }}</span>
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
                        <div class="form-group {{ $errors->has('tanggal') ? 'has-error' : '' }}">
                            <label for="exampleFormControlInput1">Tanggal</label>
                            <input name="tanggal" type="date" class="form-control" id="inputnoinduk"
                                placeholder="Input Tanggal" value="{{ $data->tanggal }}">
                            @if ($errors->has('tanggal'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('tanggal') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('jk') ? 'has-error' : '' }}">
                            <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                            <select name="jk" class="form-control" id="exampleFormControlSelect1">
                                <option value="">-Pilih-</option>
                                <option value="1" @if ($data->jk == '1') selected @endif>Diskon dan PPN 10%
                                </option>
                                <option value="2" @if ($data->jk == '2') selected @endif>Diskon dan PPN 0%
                                </option>
                                <option value="3" @if ($data->jk == '3') selected @endif>Diskon 10% dan PPN 0%
                                </option>
                                <option value="4" @if ($data->jk == '4') selected @endif>Diskon 0% dan PPN 10%
                                </option>
                            </select>
                            @if ($errors->has('jk'))
                                <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('jk') }}</span>
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
