<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Role::create([
        //     'name' => 'admin'
        // ]);
        // \App\Models\Role::create([
        //     'name' => 'user'
        // ]);

        // \DB::table('lokasi')->insert([
        //     ['name' => 'Surabaya'],
        //     ['name' => 'Gresik'],
        //     ['name' => 'Probolinggo'],
        //     ['name' => 'Semarang'],
        //     ['name' => 'Tegal']
        // ]);
        \App\Models\User::factory(1)->create();

    }
}
