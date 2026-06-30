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

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_petugas_login_with_email_and_password_redirects_to_admin_dashboard(): void
    {
        $email = Str::random(10) . '@example.com';

        $user = User::create([
            'nama' => 'Admin Test',
            'email' => $email,
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $response = $this->post(route('prosesLoginPetugas'), [
            'email' => $email,
            'password' => '12345678',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user, 'web');
    }

    public function test_warga_user_accessing_admin_dashboard_redirects_to_warga_dashboard(): void
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
            'email' => Str::random(10) . '@example.com',
            'password' => Hash::make('12345678'),
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Test',
        ]);

        $this->actingAs($warga, 'warga');

        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('warga.dashboard'));
    }

    public function test_authenticated_web_user_cannot_access_login_page(): void
    {
        $user = User::create([
            'nama' => 'Admin Test',
            'email' => Str::random(10) . '@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->get(route('login'));

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_authenticated_warga_user_cannot_access_warga_login_page(): void
    {
        $rw = rw::create([
            'nomor_rw' => '002',
        ]);

        $rt = rt::create([
            'rw_id' => $rw->id,
            'nomor_rt' => '002',
        ]);

        $warga = Warga::create([
            'rt_id' => $rt->id,
            'nama' => 'Warga Login Test',
            'email' => Str::random(10) . '@example.com',
            'password' => Hash::make('12345678'),
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Login',
        ]);

        $this->actingAs($warga, 'warga');

        $response = $this->get(route('warga.login'));

        $response->assertRedirect(route('warga.dashboard'));
    }
}
