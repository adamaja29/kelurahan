<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuratPengantarRequest;
use App\Models\jenis_surat;
use App\Models\surat_pengantar;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class SuratPengantarController extends Controller
{
    public function index()
    {
        $jenisSurat = jenis_surat::where('perlu_pengantar', true)
            ->orderBy('nama')
            ->get();

        return view('warga.surat_pengantar.index', compact('jenisSurat'));
    }

    public function suratSaya()
    {
        $suratPengantarSaya = surat_pengantar::with('jenisSurat')
            ->where('warga_id', Auth::guard('warga')->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('warga.surat_saya.pengantar', compact('suratPengantarSaya'));
    }


    public function create(jenis_surat $jenisSurat)
    {
        if (! $jenisSurat->perlu_pengantar) {
            abort(404);
        }

        $formView = $this->resolveFormView($jenisSurat);

        return view('warga.surat_pengantar.create', compact('jenisSurat', 'formView'));
    }

    public function store(StoreSuratPengantarRequest $request)
    {
        $jenisSurat = jenis_surat::findOrFail($request->validated('jenis_surat_id'));

        $dataPengajuan = $this->transformFileUploads(
            $request->file('data_pengajuan', []),
            $request->input('data_pengajuan', [])
        );

        surat_pengantar::create([
            'warga_id' => Auth::guard('warga')->id(),
            'jenis_surat_id' => $jenisSurat->id,
            'data_pengajuan' => $dataPengajuan,
            'status' => 'menunggu_rt',
        ]);

        return redirect()->route('warga.suratPengantar.index')
            ->with('success', 'Pengajuan surat pengantar berhasil terkirim.');
    }

    private function resolveFormView(jenis_surat $jenisSurat): string
    {
        $aliases = [
            'skd' => 'skd',
            '470' => 'skd',
            'sku' => 'sku',
            '503' => 'sku',
            'sktm' => 'sktm',
            '474' => 'sktm',
        ];

        $normalized = strtolower(str_replace([' ', '.'], '', $jenisSurat->kode_surat));
        $viewKey = $aliases[$normalized] ?? $normalized;
        $viewName = 'warga.surat_pengantar.forms.' . $viewKey;

        return view()->exists($viewName) ? $viewName : 'warga.surat_pengantar.forms.default';
    }

    private function transformFileUploads(array $files, array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->transformFileUploads(
                    is_array($files[$key] ?? null) ? $files[$key] : [],
                    $value
                );

                continue;
            }

            if (isset($files[$key]) && $files[$key] instanceof UploadedFile) {
                $data[$key] = $files[$key]->store('surat_pengantar', 'public');
            }
        }

        return $data;
    }


}
