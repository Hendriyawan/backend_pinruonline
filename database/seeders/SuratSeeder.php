<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Surat::create([
            'id' => 1,
            'id_user' => 2,
            'username' => 'user001',
            'validator' => '',
            'kode_surat' => 'BEMUIC',
            'tanggal_masuk_surat' => '2021-02-07',
            'nomor_surat' => 11,
            'lampiran' => '1 (satu) lembar',
            'perihal' => 'Peminjaman Tempat',
            'nama_kegiatan' => 'seminar',
            'tanggal_surat' => '2021-04-28',
            'waktu' => 120,
            'tempat' => 'Gedung Seminar Universitas Unggul Menang',
            'tanggal_pinjam' => '2021-05-01',
            'tanggal_kembali' => '2021/05/02',
            'up_surat' => 'Kepala Bagian Sarana dan Prasarana
            Universitas Unggul Menang Kota Bandung',
            'status_surat' => 'pending',
            'update_by' => '',
            'notes' => '',
            'created_at' => '2021-02-07 17:14:20',
            'updated_at' => '2021-02-07 17:14:20'
        ]);
    }
}
