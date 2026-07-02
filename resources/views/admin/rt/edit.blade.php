@extends('layouts.admin')

@section('title', 'Edit Data User RT')

@section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Edit Data User RT</h3>
            <a href="{{ route('admin.dataRT') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
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

            <form action="{{ route('admin.rt.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password (opsional)</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor RT</label>
                        <select name="rt_id" class="form-select" required>
                            <option value="">-- Pilih RT --</option>
                            @foreach($rts as $rt)
                                <option value="{{ $rt->id }}" @selected(old('rt_id', $user->rt_id) == $rt->id)>
                                    {{ $rt->rw ? 'RW ' . $rt->rw->nomor_rw . ' - ' : '' }}RT {{ $rt->nomor_rt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.dataRT') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
