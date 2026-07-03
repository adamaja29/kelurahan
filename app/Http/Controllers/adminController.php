<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\rt;
use App\Models\rw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller {

    // CRUD WARGA
    public function dataWarga(Request $request) {
        $search = trim((string) $request->input('search', ''));

        $wargas = Warga::query()->with(['rt.rw']);

        if ($search !== '') {
            $wargas->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhereHas('rt', function ($rtQuery) use ($search) {
                        $rtQuery->where('nomor_rt', 'like', "%{$search}%");
                    })->orWhereHas('rt.rw', function ($rwQuery) use ($search) {
                        $rwQuery->where('nomor_rw', 'like', "%{$search}%");
                    });
            });
        }

        $wargas = $wargas->latest()->paginate(10)->withQueryString();

        return view('admin.warga.data', compact('wargas', 'search'));
    }

    public function editWarga(Warga $warga) {
        return view('admin.warga.edit', compact('warga'));
    }


    public function updateWarga(Request $request, Warga $warga) {
        $validated = $request->validate([
            'rt_id' => ['required', 'integer'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:warga,email,' . $warga->id],
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $warga->update($validated);

        return redirect()->route('admin.dataWarga')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function deleteWarga(Warga $warga) {
        $warga->delete();

        return redirect()->route('admin.dataWarga')->with('success', 'Data warga berhasil dihapus.');
    }


    // CRUD USER RW
    public function dataRW(Request $request) {
        $search = trim((string) $request->input('search', ''));
        $users = User::with(['rt.rw', 'rw'])->where('role', 'rw')->when($search !== '', fn($query) => $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }))->latest()->paginate(10)->withQueryString();

        return view('admin.rw.data', compact('users', 'search'));
    }

    public function createRWUser() {
        $rws = Rw::whereNotIn('id', function ($query) {
        $query->select('rw_id')
              ->from('users')
              ->where('role', 'rw')
              ->whereNotNull('rw_id');
        })->orderBy('nomor_rw')->get();

        return view('admin.rw.create', compact('rws'));
    }


    // CRUD USER RT
    public function dataRT(Request $request) {
        $search = trim((string) $request->input('search', ''));
        $users = User::with(['rt.rw', 'rw'])->where('role', 'rt')->when($search !== '', fn($query) => $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }))->latest()->paginate(10)->withQueryString();

        return view('admin.rt.data', compact('users', 'search'));
    }

    public function createRTUser() {
        $rts = rt::with(['rw'])->orderBy('id')->get();

        return view('admin.rt.create', compact('rts'));
    }

    public function storeRTUser(Request $request) {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'rt_id' => ['required', 'integer', 'exists:rt,id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'rt';

        $rtModel = rt::with('rw')->findOrFail($validated['rt_id']);
        $validated['rw_id'] = $rtModel->rw_id;

        User::create($validated);

        return redirect()->route('admin.dataRT')->with('success', 'Data user RT berhasil ditambahkan.');
    }

    public function editRTUser(User $user) {
        abort_unless($user->role === 'rt', 404);
        $rts = rt::with(['rw'])->orderBy('id')->get();

        return view('admin.rt.edit', compact('user', 'rts'));
    }

    public function updateRTUser(Request $request, User $user) {
        abort_unless($user->role === 'rt', 404);
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8'],
            'rt_id' => ['required', 'integer', 'exists:rt,id'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $rtModel = rt::with('rw')->findOrFail($validated['rt_id']);
        $validated['rw_id'] = $rtModel->rw_id;

        $user->update($validated);

        return redirect()->route('admin.dataRT')->with('success', 'Data user RT berhasil diperbarui.');
    }

    public function deleteRTUser(User $user) {
        abort_unless($user->role === 'rt', 404);
        $user->delete();

        return redirect()->route('admin.dataRT')->with('success', 'Data user RT berhasil dihapus.');
    }


    // CRUD TABEL USER
    public function dataLurah(Request $request) {
        $role = $request->input('role');
        $search = trim((string) $request->input('search', ''));

        $roles = [
            'admin' => 'Admin',
            'superadmin' => 'Superadmin',
            'lurah' => 'Lurah',
            'rw' => 'RW',
            'rt' => 'RT',
        ];

        $users = User::with(['rt.rw', 'rw'])
            ->when($role, fn($query) => $query->where('role', $role))
            ->when($search !== '', fn($query) => $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }))->latest()->paginate(10)->withQueryString();

        return view('admin.lurah.data', compact('users', 'roles', 'role', 'search'));
    }

    public function editUser(User $user) {
        return back()->with('info', 'Fitur edit user sedang dalam pengembangan.');
    }

    public function deleteUser(User $user) {
        $user->delete();
        $redirectRoute = match ($user->role) {
            'rt' => 'admin.dataRT',
            'rw' => 'admin.dataRW',
            default => 'admin.dataLurah',
        };

        return redirect()->route($redirectRoute)->with('success', 'Data user berhasil dihapus.');
    }


    // CRUD WILAYAH RW
    public function dataWilayahRW() {
        $rws = rw::orderBy('id')->paginate(10);

        return view('admin.wilayah.dataRW', compact('rws'));
    }

    public function createWilayahRW() {
        return view('admin.wilayah.tambahRW');
    }

    public function storeWilayahRW(Request $request) {
        $validated = $request->validate([
            'nomor_rw' => ['required', 'string', 'max:255'],
            'nama_wilayah' => ['required', 'string', 'max:255'],
        ]);

        rw::create($validated);

        return redirect()->route('admin.wilayah.rw')->with('success', 'Data RW berhasil ditambahkan.');
    }

    public function editWilayahRW(rw $rwModel) {
        return view('admin.wilayah.editRW', ['rwModel' => $rwModel]);
    }

    public function updateWilayahRW(Request $request, rw $rwModel) {
        $validated = $request->validate([
            'nomor_rw' => ['required', 'string', 'max:255'],
            'nama_wilayah' => ['required', 'string', 'max:255'],
        ]);

        $rwModel->update($validated);

        return redirect()->route('admin.wilayah.rw')->with('success', 'Data RW berhasil diperbarui.');
    }

    public function deleteWilayahRW(rw $rwModel) {
        $rwModel->delete();

        return redirect()->route('admin.wilayah.rw')->with('success', 'Data RW berhasil dihapus.');
    }


    // CRUD WILAYAH RT
    public function dataWilayahRT() {
        $rts = rt::with('rw')->orderBy('id')->paginate(10);

        return view('admin.wilayah.dataRT', compact('rts'));
    }

    public function createWilayahRT() {
        return view('admin.wilayah.tambahRT');
    }

    public function editWilayahRT(rt $rtModel) {
        return view('admin.wilayah.editRT', ['rtModel' => $rtModel]);
    }

    public function updateWilayahRT(Request $request, rt $rtModel) {
        $validated = $request->validate([
            'nomor_rt' => ['required', 'string', 'max:255'],
        ]);

        $rtModel->update($validated);

        return redirect()->route('admin.wilayah.rt')->with('success', 'Data RT berhasil diperbarui.');
    }

    public function deleteWilayahRT(rt $rtModel) {
        $rtModel->delete();

        return redirect()->route('admin.wilayah.rt')->with('success', 'Data RT berhasil dihapus.');
    }
}
