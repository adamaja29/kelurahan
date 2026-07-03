@extends('layouts.admin')

@section('title', 'Edit Jenis Surat')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Edit Jenis Surat</h3>
            <a href="{{ route('admin.dataJenisSurat') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.jenisSurat.update', $jenisSurat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $jenisSurat->nama) }}" required>
                        @error('nama') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kode Surat</label>
                        <input type="text" name="kode_surat" class="form-control @error('kode_surat') is-invalid @enderror" value="{{ old('kode_surat', $jenisSurat->kode_surat) }}" required>
                        @error('kode_surat') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="perlu_pengantar" id="perlu_pengantar" {{ old('perlu_pengantar', $jenisSurat->perlu_pengantar) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perlu_pengantar">Perlu Pengantar</label>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.dataJenisSurat') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
