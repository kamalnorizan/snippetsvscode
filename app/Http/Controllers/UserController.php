<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::get();
        $users = User::with('roles.permissions','permissions')->latest()->paginate(15);
        return view('user.index',compact('users','roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function assignrole(User $user, $role)
    {
        $user->assignRole($role);
        flash('Role '.$role.' telah di daftarkan kepada pengguna '.$user->name)->success()->important();
        return back();
    }

    public function test(Role $role, User $user)
    {
        // $role = Role::find($id);
        $user->name;
        dd($id);
    }

    public function assignpermissiontorole(Role $role, $permission)
    {
        $role->givePermissionTo($permission);
        flash('Permission '.$permission.' telah di daftarkan kepada '.$role->name)->success()->important();
        return back();
    }

    public function revokerole($revoke, $id, $process)
    {
        if ($process=='revokeRole') {
            $user = User::find($id);
            $user->removeRole($revoke);
            flash('Role '.$revoke.' has been romoved from user '.$user->name)->warning()->important();
        }elseif($process=='revokeDirectPermission'){
            $user = User::find($id);
            $user->revokePermissionTo($revoke);
            flash('Permission '.$revoke.' has been romoved from user '.$user->name)->warning()->important();
        }else{
            $role=Role::find($id);
            $role->revokePermissionTo($revoke);
            flash('Permission '.$revoke.' has been romoved from role '.$role->name)->warning()->important();
        }
        return back();
    }

    public function assignpermissiontouser(User $user, $permission)
    {
        $user->givePermissionTo($permission);
        flash('Permission assigned to user successfully')->success()->important();
        return back();
    }
}
