@extends('layouts.admin')

@section('title', 'Wilayah RW')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Wilayah RW</h3>
            <a href="{{ route('admin.wilayah.rw.create') }}" class="btn btn-sm btn-primary">Tambah Wilayah RW</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor RW</th>
                            <th>Nama Daerah / Wilayah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rws as $index => $rw)
                            <tr>
                                <td>{{ $rws->firstItem() + $index }}</td>
                                <td>{{ $rw->nomor_rw }}</td>
                                <td>{{ $rw->nama_wilayah }}</td>
                                <td>
                                    <a href="{{ route('admin.wilayah.rw.edit', $rw->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.wilayah.rw.delete', $rw->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus RW ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada data RW.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $rws->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
