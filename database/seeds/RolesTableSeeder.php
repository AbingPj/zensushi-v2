<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'description' => "admin",
            'created_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'description' => "member",
            'created_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'description' => "unconfirm",
            'created_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'id' => 4,
            'description' => "inactive",
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => "Admin Zensushi",
            'email' => "admin@zensushi.com",
            'password' => Hash::make('password'),
            'role_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => "Member Zensushi",
            'email' => "member@zensushi.com",
            'password' => Hash::make('password'),
            'role_id' => 2,
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => "AbingPj",
            'email' => "abing.pj@gmail.com",
            'password' => Hash::make('password'),
            'role_id' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
