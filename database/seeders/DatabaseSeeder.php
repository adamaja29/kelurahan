<?php

namespace Database\Seeders;

use App\Models\rw;
use App\Models\rt;
use App\Models\user;
use App\Models\jenis_surat;
use App\Models\warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================
        // RW
        // ==========================
        $rw1 = rw::create([
            'nomor_rw' => '001'
        ]);

        // ==========================
        // RT
        // ==========================
        $rt1 = rt::create([
            'rw_id' => $rw1->id,
            'nomor_rt' => '001'
        ]);

        $rt2 = rt::create([
            'rw_id' => $rw1->id,
            'nomor_rt' => '002'
        ]);

        // ==========================
        // Petugas
        // ==========================
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'aktif'
        ]);

        User::create([
            'nama' => 'Lurah',
            'email' => 'lurah@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'lurah',
            'status' => 'aktif'
        ]);

        User::create([
            'nama' => 'Pak RW 001',
            'email' => 'rw001@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'rw',
            'rw_id' => $rw1->id,
            'status' => 'aktif'
        ]);

        User::create([
            'nama' => 'Pak RT 001',
            'email' => 'rt001@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'rt',
            'rt_id' => $rt1->id,
            'status' => 'aktif'
        ]);

        // ==========================
        // Jenis Surat
        // ==========================
        jenis_surat::create([
            'nama' => 'Surat Keterangan Domisili',
            'kode_surat' => '470',
            'perlu_pengantar' => true
        ]);

        jenis_surat::create([
            'nama' => 'Surat Keterangan Usaha',
            'kode_surat' => '503',
            'perlu_pengantar' => true
        ]);

        jenis_surat::create([
            'nama' => 'Surat Keterangan Kelahiran',
            'kode_surat' => '474.1',
            'perlu_pengantar' => false
        ]);

        warga::create([
        'rt_id' => $rt1->id,
        'nama' => 'Adam Nur Wicaksono',
        'email' => 'adam@gmail.com',
        'password' => Hash::make('12345678'),
        'no_hp' => '081234567890',
        'alamat' => 'Jl. Melati No. 10'
        ]);

        warga::create([
            'rt_id' => $rt1->id,
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('12345678'),
            'no_hp' => '081234567891',
            'alamat' => 'Jl. Melati No. 12'
        ]);

        warga::create([
            'rt_id' => $rt2->id,
            'nama' => 'Siti Aminah',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('12345678'),
            'no_hp' => '081234567892',
            'alamat' => 'Jl. Mawar No. 5'
        ]);
    }
}