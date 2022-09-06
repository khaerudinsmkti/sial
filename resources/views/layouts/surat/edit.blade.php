@extends('layouts.admin')

@section('main-content')
<form action="{{ route('surat.update', $data->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf      
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Edit Surat</h4>
            <div class="dropdown no-arrow">
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            </div>
        </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Jenis Surat</label>
                <select name="status" id="" class="form-control" required>
                    <option value="">Pilih Jenis</option>
                    <option value="0" @if ($data->status == 0) {{ 'selected' }} @endif>Surat Masuk</option>
                    <option value="1" @if ($data->status == 1) {{ 'selected' }} @endif>Surat Keluar</option>
                </select>
                <p class="text-danger"></p>
            </div>
            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control form-control-user "
                name="tanggal" value="{{ $data->tanggal }}" required>
                <p class="text-danger"></p>
            </div>
            <div class="form-group">
                <label for="">Asal Surat</label>
                <input type="text" class="form-control form-control-user "
                name="asal" value="{{ $data->asal }}" required>
                <p class="text-danger"></p>
            </div>
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" class="form-control form-control-user {{ $errors->has('judul') ? 'is-invalid':'' }}"
                name="judul" value="{{ $data->judul }}" required>
                <p class="text-danger">{{ $errors->first('judul') }}</p>
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control form-control-user {{ $errors->has('judul') ? 'is-invalid':'' }}" required>{{ $data->deskripsi }}</textarea>
                <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
            </div>
            <div class="form-group">
                <label for="">Lampiran PDF</label>
                <input type="file" class="form-control form-control-user {{ $errors->has('lampiran') ? 'is-invalid':'' }}"
                name="lampiran" value="{{ old('lampiran') }}">
                <p class="text-danger">{{ $errors->first('lampiran') }}</p>
            </div>
            <p>
            <iframe src="{{ asset('data_file/'. $data->lampiran) }}" width="100%" height="500px">
            </iframe>
            </p>
            <br>
            <button class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

@endsection