<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
          'name' => "admin",
          'email' => "admin@admin.com",
          'password' => Hash::make('admin222'),
         ]);

        \App\Models\Company::factory(10000)->create();
        \App\Models\Client::factory(10000)->create();
    }
}
