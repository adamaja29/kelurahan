<?php

namespace Tests\Feature;

use App\Models\rt;
use App\Models\rw;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserDataByRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_user_data_by_role(): void
    {
        $rw = rw::create([
            'nomor_rw' => '001',
        ]);

        $rt = rt::create([
            'rw_id' => $rw->id,
            'nomor_rt' => '001',
        ]);

        User::create([
            'nama' => 'RT User',
            'email' => 'rtuser@example.com',
            'password' => Hash::make('password123'),
            'role' => 'rt',
            'rt_id' => $rt->id,
            'rw_id' => $rw->id,
        ]);

        $admin = User::create([
            'nama' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'web');

        $response = $this->get(route('admin.dataLurah'));

        $response->assertOk();
        $response->assertSee('Data User berdasarkan Role');
        $response->assertSee('RT User');
        $response->assertSee('rtuser@example.com');
        $response->assertSee('RT 001');
        $response->assertSee('RW 001');
        $response->assertSee('Edit');
        $response->assertSee('Hapus');
    }

    public function test_admin_can_view_rt_users_page(): void
    {
        $rw = rw::create([
            'nomor_rw' => '002',
        ]);

        $rt = rt::create([
            'rw_id' => $rw->id,
            'nomor_rt' => '002',
        ]);

        User::create([
            'nama' => 'RT Only User',
            'email' => 'rtonly@example.com',
            'password' => Hash::make('password123'),
            'role' => 'rt',
            'rt_id' => $rt->id,
            'rw_id' => $rw->id,
        ]);

        $admin = User::create([
            'nama' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'web');

        $response = $this->get(route('admin.dataRT'));

        $response->assertOk();
        $response->assertSee('Data User RT');
        $response->assertSee('RT Only User');
        $response->assertSee('rtonly@example.com');
        $response->assertSee('RT 002');
        $response->assertSee('RW 002');
        $response->assertSee('Edit');
        $response->assertSee('Hapus');
    }

    public function test_admin_can_view_rw_users_page(): void
    {
        $rw = rw::create([
            'nomor_rw' => '003',
        ]);

        User::create([
            'nama' => 'RW Only User',
            'email' => 'rwonly@example.com',
            'password' => Hash::make('password123'),
            'role' => 'rw',
            'rw_id' => $rw->id,
        ]);

        $admin = User::create([
            'nama' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'web');

        $response = $this->get(route('admin.dataRW'));

        $response->assertOk();
        $response->assertSee('Data User RW');
        $response->assertSee('RW Only User');
        $response->assertSee('rwonly@example.com');
        $response->assertSee('RW 003');
        $response->assertSee('Edit');
        $response->assertSee('Hapus');
    }
}
