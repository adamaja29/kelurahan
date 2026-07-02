@extends('layouts.admin')

@section('title', 'Edit Wilayah RT')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Edit Wilayah RT</h3>
            <a href="{{ route('admin.wilayah.rt') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
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

            <form action="{{ route('admin.wilayah.rt.update', $rtModel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nomor RT</label>
                        <input type="text" name="nomor_rt" class="form-control" value="{{ old('nomor_rt', $rtModel->nomor_rt) }}" required>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.wilayah.rt') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

