<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->authorizeResource(User::class, 'users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::with('roles')
                    ->with('permissions')
                    ->get();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', User::class);
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $this->authorize('create', User::class);
        abort(404);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', User::class);

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', User::class);

        $roles = Role::all();
        $permissions = Permission::all();

        return view('users.edit', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', User::class);
        $status = '';
        $user->name = $request->name;
        $user->email = $request->email;
        if ($user->can('editCountCheckList', User::class)) {
            $user->max_count_check_lists = $request->maxCountCheckLists;
        }


        $user->roles()->sync($request->roles);
        $user->permissions()->sync($request->permissions);
        $user->save();
        $status = $status.'Profile updated!';
        return redirect()->route('users.show', [$user])->with('status', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //$this->authorize('delete', User::class);
        //
        abort(404);
    }

    /**
     * Block the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function block(User $user)
    {
        $this->authorize('block', User::class);

        if ($user->active == 1) {
            $user->active = 0;
            $status = 'Profile blocked!';
        }else{
            $user->active = 1;
            $status = 'Profile active!';
        }

        $user->save();

        return redirect()->route('users.edit', [$user])->with('status', $status);
    }
}
