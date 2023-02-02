<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Models\User;
use App\Services\Api\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function view($id){
        try {
            $user = User::find($id);
            return response()->json([
                'status' => 200,
                'data' => $user,
            ]);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateUserRequest $request, $id){
        \DB::beginTransaction();
        try {
            $profile=$this->service->update($request, $id);
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully edit profile',
                'user' => $profile,
            ]);
            \DB::commit();
        }catch (\Exception $e){
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
