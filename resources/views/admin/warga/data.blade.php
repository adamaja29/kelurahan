@extends('layouts.admin')

@section('title', 'Data Warga')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Warga</h3>
        </div>

        <div class="card-body">
            <!-- @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif -->

            <form action="{{ route('admin.dataWarga') }}" method="GET" class="row g-2 mb-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, email, alamat, RT, RW, atau no HP" value="{{ old('search', $search ?? '') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('admin.dataWarga') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>RT</th>
                            <th>RW</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wargas as $index => $warga)
                            <tr>
                                <td>{{ $wargas->firstItem() + $index }}</td>
                                <td>{{ $warga->nama }}</td>
                                <td>{{ $warga->email }}</td>
                                <td>{{ $warga->no_hp }}</td>
                                <td>{{ $warga->alamat }}</td>
                                <td>{{ $warga->rt ? 'RT ' . $warga->rt->nomor_rt : '-' }}</td>
                                <td>{{ $warga->rt && $warga->rt->rw ? 'RW ' . $warga->rt->rw->nomor_rw : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.warga.edit', $warga->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.warga.delete', $warga->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data warga ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data warga.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $wargas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection