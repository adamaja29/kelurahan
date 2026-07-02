@extends('layouts.admin')

@section('title', 'Wilayah RT')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Wilayah RT</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor RT</th>
                            <th>Nomor RW</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rts as $index => $rt)
                            <tr>
                                <td>{{ $rts->firstItem() + $index }}</td>
                                <td>{{ $rt->nomor_rt }}</td>
                                <td>{{ $rt->rw ? $rt->rw->nomor_rw : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.wilayah.rt.edit', $rt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.wilayah.rt.delete', $rt->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus RT ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data RT.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $rts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
