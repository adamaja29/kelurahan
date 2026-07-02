@extends ('layouts.admin')
@section('title','Dashboard')
@section('content')
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="text-secondary">Total Warga</div>
                                <div class="h1">0</div>
                            </div>
                            <i class="bi bi-people fs-1 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="text-secondary">Pengajuan</div>
                                <div class="h1">0</div>
                            </div>
                            <i class="bi bi-envelope fs-1 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="text-secondary">Disetujui</div>
                                <div class="h1">0</div>
                            </div>
                            <i class="bi bi-check-circle fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="text-secondary">Ditolak</div>
                                <div class="h1">0</div>
                            </div>
                            <i class="bi bi-x-circle fs-1 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Selamat Datang</h3>
            </div>
            <div class="card-body">
                Ini adalah halaman dashboard admin Sistem Surat Kelurahan.
            </div>
        </div>
    </div>

@endsection
