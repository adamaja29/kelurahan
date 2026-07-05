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
    <label for="tujuan" class="form-label">Tujuan Surat</label>
    <input type="text" id="tujuan" name="data_pengajuan[tujuan]" class="form-control @error('data_pengajuan.tujuan') is-invalid @enderror" value="{{ old('data_pengajuan.tujuan') }}" required>
    @error('data_pengajuan.tujuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="file_keterangan" class="form-label">Unggah Surat Keterangan (opsional)</label>
    <input type="file" id="file_keterangan" name="data_pengajuan[file_keterangan]" class="form-control @error('data_pengajuan.file_keterangan') is-invalid @enderror">
    @error('data_pengajuan.file_keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
