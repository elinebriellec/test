<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //-----tambah user
        DB::table('users')->insert([
            'name' => 'Anggota',
            'email' => 'anggota@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        //-----tambah role
        $roles=[
            ['nama' => 'Admin','kode' => 'ADMIN'],
            ['nama' => 'Anggota','kode' => 'ANGGOTA'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }

        //-----tambah user_role
        $users=User::all();
        foreach ($users as $user) {
            $userRole = new UserRole();
            $userRole->user_id = $user->id;
            $userRole->role_id = Role::where('kode', 'ANGGOTA')->first()->id;
            $userRole->save();
        }

        //-----tambah user_role admin
        $admin=User::where('email','admin@gmail.com')->first();
        if($admin){//-----jika user admin ditemukan
            $admin_role=Role::where('kode', 'ADMIN')->first();
            if($admin_role){//-----jika role admin ditemukan
                $userRole = new UserRole();
                $userRole->user_id = $admin->id;
                $userRole->role_id = $admin_role->id;
                $userRole->save();
            }
        }

    }
}
