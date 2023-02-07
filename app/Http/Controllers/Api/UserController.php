<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function view(Request $request){
        try {
            $user_id = $request->id;
            $user = User::with('profile')->find($user_id);
            return response()->json([
                'status' => 200,
                'data' => $user
            ]);
        }catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(Request $request){
        \DB::beginTransaction();
        try {
            $user_id = $request->id;
            $user = User::find($user_id);
            $request->validate([
                'dob' => 'required|string',
                'gender' => 'required',
                'phone' => 'required|regex:/(0)[0-9]{9}/',
                'address' => 'string|max:1000',
                'imgae' => 'max:2048',
            ]);
            if (!empty($request['name'])){
                $user->fill(['name' => $request->name])->save();
            }
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $storedPath = $file->storeAs('images/users', $fileName);
            }
            $data_user = $user->profile()->updateOrCreate(
                ['user_id' => $user_id],
                [
                    'user_id' => $user_id,
                    'dob' => $request->dob,
                    'phone'=> $request->phone,
                    'gender'=> $request->gender,
                    'address'=> !empty($request->address) ? $request->address : '',
                    'image' => isset($storedPath) ? $storedPath : '',
                ]
            );
            \DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật thành công',
                'data' => $data_user
            ]);
        }catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function cart_index($id){

    }
}
