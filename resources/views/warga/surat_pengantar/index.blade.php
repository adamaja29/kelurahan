@extends('layouts.warga')

@section('title', 'Ajukan Surat Pengantar')
@section('page_title', 'Ajukan Surat Pengantar')

@section('content')
    <div class="row row-cards">
        @forelse($jenisSurat as $jenis)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <span class="avatar bg-primary text-white rounded-circle">{{ strtoupper(substr($jenis->kode_surat, 0, 1)) }}</span>
                            </div>
                            <div>
                                <h3 class="card-title mb-1">{{ $jenis->nama }}</h3>
                                <div class="text-muted">Kode: {{ strtoupper($jenis->kode_surat) }}</div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0">Pilih jenis surat untuk membuka formulir pengajuan khusus.</p>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('warga.suratPengantar.create', ['jenisSurat' => $jenis->kode_surat]) }}" class="btn btn-primary">Ajukan</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0">Belum ada jenis surat yang tersedia untuk pengajuan.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
