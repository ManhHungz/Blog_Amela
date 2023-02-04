<?php


namespace App\Services\Api;


use App\Models\User;

class UserService
{
    public function update($request, $id){
        $user = User::find($id);
        $profile = $user->profile()->updateOrCreate([
            'user_id' => !empty($id)?$id:'',
            'name' => !empty($request['name'])?$request['name']:'',
            'dob' => !empty($request['dob'])?$request['dob']:'',
            'email' => !empty($request['email'])?$request['email']:'',
            'gender' => !empty($request['gender'])?$request['gender']:'',
            'phone' => !empty($request['phone'])?$request['phone']:'',
            'address' => !empty($request['address'])?$request['address']:'',
            'image' => !empty($request['image'])?$request['image']:'',
        ]);
        return $profile;
    }
}
