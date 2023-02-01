<?php


namespace App\Services\CMS;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store($request){
        $status = false;
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $insert = User::create($input);
        if(!empty($insert)){
            $index['user_id'] = $insert->id;
            $index['role_id'] = $input['role'];
            DB::table('roles_users')->insert($index);
            $status=true;
        }
        return $status;
    }

    public function update($request, $id){
        $input = $request->all();
        $user = User::find($id);
        $role = $input['role'];
        unset($input['role']);
        $user->fill($input)->save();
        if(DB::table('roles_users')->where('user_id',$id)->update([
            'role_id' => $role
        ])){
            return true;
        }
        return false;
    }
}
