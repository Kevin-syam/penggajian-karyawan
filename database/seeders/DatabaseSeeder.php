<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $departemen = \App\Models\Departemen::create([
            'nama' => 'Human Resources',
        ]);

        $admin = \App\Models\User::factory()->create([
            'name'  => 'Admin User',
            'email' => 'admin@admin.com',
            'level' => 'admin',
        ]);

        $detail_dmin = \App\Models\Pegawai::factory()->create([
            'user_id'       => $admin->id,
            'departemen_id' => $departemen->id,
            'jabatan'       => 'Admin/Kepala',
        ]);

        $user_pria = \App\Models\User::factory()->create([
            'name'  => 'User Pria',
            'email' => 'user_pria@mail.com',
            'level' => 'pegawai',
        ]);

        \App\Models\Pegawai::factory()->create([
            'user_id'       => $user_pria->id,
            'departemen_id' => $departemen->id,
            'jabatan'       => 'Staf',
        ]);

        \App\Models\Absen::factory(12)->create([
            'user_id'       => $user_pria->id,
        ]);

        $user_wanita = \App\Models\User::factory()->create([
            'name'  => 'User Wanita',
            'email' => 'user_wanita@mail.com',
            'level' => 'pegawai',
        ]);

        \App\Models\Pegawai::factory()->create([
            'user_id'       => $user_wanita->id,
            'departemen_id' => $departemen->id,
            'jenis_kelamin' => 'Wanita',
            'jabatan'       => 'Staf',
        ]);

        \App\Models\Absen::factory(10)->create([
            'user_id'       => $user_wanita->id,
        ]);
    }
}
