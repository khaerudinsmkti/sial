@extends('layouts.admin')

@section('main-content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Surat Masuk <span class="badge badge-danger">{{ $totalsurat }}</span></h4>
            <div class="dropdown no-arrow">
                <a class="btn btn-success" href="{{ route('input-surat') }}">+ Add</a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="offset-md-9 col-md-3 mb-3">
            <form action="{{ route('surat.index') }}" method="GET">
                <input type="text" name="q" class="form-control" placeholder="Cari ...">
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                    @endphp

                    @forelse ($data as $no =>$item)
                    <tr>
                        <td>{{ ++$no + ($data->currentPage()-1) * $data->perPage() }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{!! \Illuminate\Support\Str::limit($item->judul, 50) !!}</td>
                        <td>{!! \Illuminate\Support\Str::limit($item->deskripsi, 70) !!}</td>
                        <td>
                            <form action="{{ route('surat.destroy', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <a class="btn btn-success btn-sm" href="{{ route('surat.show',$item->id) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" href="{{ route('surat.edit',$item->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm delete-link" onclick="return confirm('Kamu yakin mau menghapus surat dari {{ $item->asal }} ini?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                    @endforelse
                
                </tbody>
            </table>
            <br>
                {{ $data->links() }}
        </div>    
    </div>

@endsection