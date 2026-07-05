@extends('layouts.warga')

@section('title', 'Surat Pengantar Saya')
@section('page_title', 'Surat Pengantar Saya')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Surat Pengantar Anda</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th style="width: 60px">No</th>
                        <th>Jenis Surat</th>
                        <th>Nomor Surat</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th style="width: 120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratPengantarSaya as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ optional($item->jenisSurat)->nama ?? '-' }}
                                @if(!empty(optional($item->jenisSurat)->kode_surat))
                                    <span class="text-muted">({{ optional($item->jenisSurat)->kode_surat }})</span>
                                @endif
                            </td>
                            <td>{{ $item->nomor_surat ?? '-' }}</td>
                            <td>
                                @php $status = $item->status ?? '-'; @endphp
                                <span class="badge {{ $status === 'menunggu_rt' ? 'bg-warning' : ($status === 'ditolak' ? 'bg-danger' : 'bg-primary') }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td>{{ optional($item->created_at)->format('d/m/Y') ?? '-' }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada pengajuan surat pengantar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

