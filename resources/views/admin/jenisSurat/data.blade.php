@extends('layouts.admin')

@section('title', 'Data Jenis Surat')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Jenis Surat</h3>
            <a href="{{ route('admin.jenisSurat.create') }}" class="btn btn-sm btn-primary">Tambah Jenis Surat</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Perlu Pengantar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenisSurats as $js)
                            <tr>
                                <td>{{ $js->id }}</td>
                                <td>{{ $js->nama }}</td>
                                <td>{{ $js->kode_surat }}</td>
                                <td>{{ $js->perlu_pengantar ? 'Ya' : 'Tidak' }}</td>
                                <td>
                                    <a href="{{ route('admin.jenisSurat.edit', $js->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('admin.jenisSurat.delete', $js->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus jenis surat ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $jenisSurats->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
