<div class="mb-3">
    <label for="nama" class="form-label">Nama Lengkap</label>
    <input type="text" id="nama" name="data_pengajuan[nama]" class="form-control @error('data_pengajuan.nama') is-invalid @enderror" value="{{ old('data_pengajuan.nama') }}" required>
    @error('data_pengajuan.nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <textarea id="alamat" name="data_pengajuan[alamat]" class="form-control @error('data_pengajuan.alamat') is-invalid @enderror" rows="3" required>{{ old('data_pengajuan.alamat') }}</textarea>
    @error('data_pengajuan.alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="keperluan" class="form-label">Keperluan</label>
    <input type="text" id="keperluan" name="data_pengajuan[keperluan]" class="form-control @error('data_pengajuan.keperluan') is-invalid @enderror" value="{{ old('data_pengajuan.keperluan') }}" required>
    @error('data_pengajuan.keperluan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="file_ktp" class="form-label">Unggah KTP (opsional)</label>
    <input type="file" id="file_ktp" name="data_pengajuan[file_ktp]" class="form-control @error('data_pengajuan.file_ktp') is-invalid @enderror">
    @error('data_pengajuan.file_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
