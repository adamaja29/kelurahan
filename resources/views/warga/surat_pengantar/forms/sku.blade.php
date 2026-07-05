<div class="mb-3">
    <label for="nama" class="form-label">Nama Pemohon</label>
    <input type="text" id="nama" name="data_pengajuan[nama]" class="form-control @error('data_pengajuan.nama') is-invalid @enderror" value="{{ old('data_pengajuan.nama') }}" required>
    @error('data_pengajuan.nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="nama_usaha" class="form-label">Nama Usaha</label>
    <input type="text" id="nama_usaha" name="data_pengajuan[nama_usaha]" class="form-control @error('data_pengajuan.nama_usaha') is-invalid @enderror" value="{{ old('data_pengajuan.nama_usaha') }}" required>
    @error('data_pengajuan.nama_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
    <textarea id="alamat_usaha" name="data_pengajuan[alamat_usaha]" class="form-control @error('data_pengajuan.alamat_usaha') is-invalid @enderror" rows="3" required>{{ old('data_pengajuan.alamat_usaha') }}</textarea>
    @error('data_pengajuan.alamat_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="file_ktp" class="form-label">Unggah KTP (opsional)</label>
    <input type="file" id="file_ktp" name="data_pengajuan[file_ktp]" class="form-control @error('data_pengajuan.file_ktp') is-invalid @enderror">
    @error('data_pengajuan.file_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
