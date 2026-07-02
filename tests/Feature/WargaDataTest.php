<?php

namespace Tests\Feature;

use App\Models\rt;
use App\Models\rw;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class WargaDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_warga_data_table(): void
    {
        $rw = rw::create([
            'nomor_rw' => '001',
        ]);

        $rt = rt::create([
            'rw_id' => $rw->id,
            'nomor_rt' => '001',
        ]);

        $warga = Warga::create([
            'rt_id' => $rt->id,
            'nama' => 'Warga Test',
            'email' => 'warga@example.com',
            'password' => Hash::make('12345678'),
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Test No. 1',
        ]);

        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => Str::random(10) . '@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'web');

        $response = $this->get(route('admin.dataWarga'));

        $response->assertOk();
        $response->assertSee('Data Warga');
        $response->assertSee('Cari nama, email, alamat, RT, RW, atau no HP');
        $response->assertSee('Edit');
        $response->assertSee('Hapus');
        $response->assertSee('RT 001');
        $response->assertSee('RW 001');
        $response->assertSee($warga->nama);
        $response->assertSee($warga->email);
        $response->assertSee($warga->no_hp);
    }
}
