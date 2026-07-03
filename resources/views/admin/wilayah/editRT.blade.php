@extends('layouts.admin')

@section('title', 'Edit Wilayah RT')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Edit Wilayah RT</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.wilayah.rt.update', $rtModel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">RW</label>

                        <select name="rw_id" class="form-select @error('rw_id') is-invalid @enderror" required>
                            <option value="">-- Pilih RW --</option>

                            @foreach($rws as $rw)
                                <option value="{{ $rw->id }}"
                                    {{ old('rw_id', $rtModel->rw_id) == $rw->id ? 'selected' : '' }}>
                                    RW {{ $rw->nomor_rw }}
                                    @if($rw->nama_wilayah)
                                        - {{ $rw->nama_wilayah }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('rw_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor RT</label>

                        <input type="text"
                            name="nomor_rt"
                            class="form-control @error('nomor_rt') is-invalid @enderror"
                            value="{{ old('nomor_rt', $rtModel->nomor_rt) }}"
                            required>
                        @error('nomor_rt')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
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

