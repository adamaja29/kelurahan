<?php

namespace App\Http\Requests;

use App\Models\jenis_surat;
use Illuminate\Foundation\Http\FormRequest;

class StoreSuratPengantarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guard('warga')->check();
    }

    public function rules(): array
    {
        $rules = [
            'jenis_surat_id' => ['required', 'integer', 'exists:jenis_surat,id'],
            'data_pengajuan' => ['required', 'array'],
        ];

        $jenisSurat = null;
        if ($this->filled('jenis_surat_id')) {
            $jenisSurat = jenis_surat::find($this->input('jenis_surat_id'));
        }

        if ($jenisSurat) {
            $normalizedCode = strtolower(str_replace([' ', '.'], '', $jenisSurat->kode_surat));

            switch ($normalizedCode) {
                case 'skd':
                case '470':
                    $rules = array_merge($rules, [
                        'data_pengajuan.nama' => ['required', 'string', 'max:255'],
                        'data_pengajuan.alamat' => ['required', 'string', 'max:255'],
                        'data_pengajuan.keperluan' => ['required', 'string', 'max:255'],
                        'data_pengajuan.file_ktp' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
                    ]);
                    break;
                case 'sku':
                case '503':
                    $rules = array_merge($rules, [
                        'data_pengajuan.nama' => ['required', 'string', 'max:255'],
                        'data_pengajuan.nama_usaha' => ['required', 'string', 'max:255'],
                        'data_pengajuan.alamat_usaha' => ['required', 'string', 'max:255'],
                        'data_pengajuan.file_ktp' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
                    ]);
                    break;
                case 'sktm':
                case '4741':
                    $rules = array_merge($rules, [
                        'data_pengajuan.nama' => ['required', 'string', 'max:255'],
                        'data_pengajuan.alamat' => ['required', 'string', 'max:255'],
                        'data_pengajuan.tujuan' => ['required', 'string', 'max:255'],
                        'data_pengajuan.file_keterangan' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
                    ]);
                    break;
                default:
                    $rules = array_merge($rules, [
                        'data_pengajuan.nama' => ['required', 'string', 'max:255'],
                        'data_pengajuan.alamat' => ['required', 'string', 'max:255'],
                    ]);
                    break;
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'data_pengajuan.*.required' => 'Field :attribute wajib diisi.',
            'data_pengajuan.*.file' => 'Field :attribute harus berupa file yang valid.',
            'data_pengajuan.*.mimes' => 'Field :attribute harus berupa file JPG, JPEG, PNG, atau PDF.',
            'data_pengajuan.*.max' => 'Ukuran file :attribute maksimal 5MB.',
        ];
    }
}
