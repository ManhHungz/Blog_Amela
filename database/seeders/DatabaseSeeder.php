<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         try {
//             $user = User::create([
//                 'name' => 'admin',
//                 'email' => 'admin@gmail.com',
//                 'dob' => '1999-02-01',
//                 'gender' => 1,
//                 'phone' => '0987654320',
//                 'address' => 'admin',
//                 'image' => '',
//                 'password' => Hash::make('1234567890')
//             ]);

//             $role = Role::firstOrCreate(['name' => 'Admin']);

//             DB::table('roles_users')
//                 ->insert(['user_id' => $user->id, 'role_id' => $role->id]);
//         } catch (\Exception $e) {
//             \DB::rollBack();
//             throw new \Exception($e->getMessage());
//         }
    }
}
