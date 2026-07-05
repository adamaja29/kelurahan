@extends('layouts.warga')

@section('title', 'Form Pengajuan ' . $jenisSurat->nama)
@section('page_title', 'Form Pengajuan ' . $jenisSurat->nama)

@section('content')
    <form action="{{ route('warga.suratPengantar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="jenis_surat_id" value="{{ $jenisSurat->id }}">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $jenisSurat->nama }}</h3>
                <div class="card-actions">
                    <a href="{{ route('warga.suratPengantar.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                @if (View::exists($formView))
                    @include($formView, ['jenisSurat' => $jenisSurat])
                @else
                    <div class="alert alert-warning">
                        Form untuk jenis surat {{ $jenisSurat->nama }} belum tersedia.
                    </div>
                @endif
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
            </div>
        </div>
    </form>
@endsection
