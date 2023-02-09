<?php


namespace App\Services\CMS;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($request){
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['dob'] = '1999-01-01';
        $input['gender'] = \App\Constants\User::MALE;
        $input['phone'] = 987654320;
        $input['address'] = '';
        $input['image'] = '';
        $role = $input['role'];
        unset($input['role']);
        $insert = User::create($input);
        if(!empty($insert)){
            $index['user_id'] = $insert->id;
            $index['role_id'] = $role;
            DB::table('roles_users')->insert($index);
        }
    }

    public function update($request, $id){
        $input = $request->all();
        $user = User::find($id);
        $role = $input['role'];
        unset($input['role']);
        $user->fill($input)->save();
        $user->roles()->sync($role);
    }
}
