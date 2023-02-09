<?php

namespace App\Http\Controllers;

use App\Constants\Paginations;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\CMS\UserService;
use App\Models\User;
use App\Models\Role;
use DB;
use Hash;
use Session;

class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $datas = User::orderBy('id', 'DESC')->paginate(Paginations::SHOW_ITEMS);
            return view('users.index', compact('datas'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $roles = Role::pluck('name')->all();
            return view('users.create', compact('roles'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        \DB::beginTransaction();
        try {
            $this->service->store($request);
            \DB::commit();
            return redirect()->route('users.index')->with('flash_message', 'Create successfully');
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::find($id);
            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::find($id);
            $roles = Role::get();
            $user_role = array_merge(...array_values(array_unique(array_column($user->roles->toArray(), 'pivot'))));
            $user['role_id'] = $user_role['role_id'];
            return view('users.edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $this->service->update($request, $id);
            \DB::commit();
            return redirect()->route('users.index')->with('flash_message', 'User updated successfully');
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            User::find($id)->delete();
            \DB::commit();
            return redirect()->route('users.index')->with('flash_message', 'Deleted successfully');
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
