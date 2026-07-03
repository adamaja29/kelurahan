@extends('layouts.admin')

@section('title', 'Edit Wilayah RW')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Edit Wilayah RW</h3>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.wilayah.rw.update', $rwModel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nomor RW</label>
                        <input type="text" name="nomor_rw" class="form-control" value="{{ old('nomor_rw', $rwModel->nomor_rw) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Daerah / Wilayah</label>
                        <input type="text" name="nama_wilayah" class="form-control" value="{{ old('nama_wilayah', $rwModel->nama_wilayah) }}" required>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.wilayah.rw') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

