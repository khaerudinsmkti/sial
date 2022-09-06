@extends('layouts.admin')

@section('main-content')
<form action="{{ route('surat.store') }}" method="post" enctype="multipart/form-data">
    @csrf      
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Tambah Surat</h4>
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
                    <option value="0">Surat Masuk</option>
                    <option value="1">Surat keluar</option>
                </select>
                <p class="text-danger"></p>
            </div>
            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control form-control-user "
                name="tanggal" value="" required>
                <p class="text-danger"></p>
            </div>
            <div class="form-group">
                <label for="">Asal Surat</label>
                <input type="text" class="form-control form-control-user "
                name="asal" value="" required>
                <p class="text-danger"></p>
            </div>
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" class="form-control form-control-user {{ $errors->has('judul') ? 'is-invalid':'' }}"
                name="judul" value="{{ old('judul') }}" required>
                <p class="text-danger">{{ $errors->first('judul') }}</p>
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control form-control-user {{ $errors->has('judul') ? 'is-invalid':'' }}" required></textarea>
                <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
            </div>
            <div class="form-group">
                <label for="">Lampiran PDF</label>
                <input type="file" class="form-control form-control-user {{ $errors->has('lampiran') ? 'is-invalid':'' }}"
                name="lampiran" value="{{ old('lampiran') }}">
                <p class="text-danger">{{ $errors->first('lampiran') }}</p>
            </div>
            <br>
            <button class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

@endsection