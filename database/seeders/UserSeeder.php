<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'id' => 1,
            'username' => 'admin',
            'password' => '$2y$10$T3BMcPDXJPrwVW84mCP0u.WrYbWH7RDX5gppstKdp4sR1s3IU9Q0K', //password = admin123456
            'role' => 'admin',
            'created_at' => '2021-02-07 15:38:03',
            'updated_at' => '2021-02-07 15:38:03'
        ]);

        \App\Models\User::create([
            'id' => 2,
            'username' => 'user001',
            'password' => '$2y$10$XzP1FzH41UZ3y1sZquScquBgddAKuH9ME1eDZWg3vYovW46l1fAsC', //password = password123456
            'role' => 'user',
            'created_at' => '2021-02-07 15:38:03',
            'updated_at' => '2021-02-07 15:38:03'
        ]);

        \App\Models\User::create([
            'id' => 3, 
            'username' => 'user002',
            'password' => '$2y$10$VJxBC/bpfGxZ1FsVw3yx7.OJGEPAb2Fu8zdJIqJcrCJAN8rJbH6DG', //password = password123456
            'role' => 'user',
            'created_at' => '2021-02-22 14:25:41',
            'updated_at' => '2021-02-22 14:25:41'
        ]);

        \App\Models\User::create([
            'id' => 4,
            'username' => 'validator001',
            'password' => '$2y$10$GKfh8nCJ8PN/XtSKINZNZ.oJ0ipWD/qfVx0Mef8l2R0l3JeFzdAxi', //password = validator123456
            'role' => 'validator',
            'created_at' => '2021-02-22 14:23:05',
            'updated_at' => '2021-02-22 14:23:05'
        ]);
    }
}
