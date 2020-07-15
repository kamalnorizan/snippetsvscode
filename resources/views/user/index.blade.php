@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Roles</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>
                                Role
                            </td>
                            <td>
                                Permission
                            </td>
                            <td>
                                Action
                            </td>
                        </tr>
                        @foreach ($roles as $role)
                        <tr>
                            <td>
                                {{ucfirst($role->name)}}
                            </td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                <a onclick="return confirm('Are you sure you want to remove this permission from this role?')" href="{{route('user.revokerole',['revoke'=>$permission->name,'id'=>$role->id,'process'=>'revokePermission'])}}" class="badge badge-pill badge-success">
                                    {{$permission->name}}
                                </a>
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="">
                                    <div class="btn-group" role="group">
                                        <button id="dropdownId" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                        Assign Permission
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                        @foreach ($permissions as $permission)
                                        <a class="dropdown-item" href="{{route('user.assignpermissiontorole',['permission'=>$permission->name,'role'=>$role->id])}}">{{$permission->name}}</a>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Role(s)</td>
                            <td>Permission(s)</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                @foreach ($user->roles as $role)
                                <a onclick="return confirm('Are you sure you want to remove this role from this user?')" href="{{route('user.revokerole',['revoke'=>$role->name,'id'=>$user->id,'process'=>'revokeRole'])}}" class="badge badge-pill badge-primary">
                                    {{$role->name}}
                                </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($user->getAllPermissions() as $permission)
                                <span class="badge badge-pill badge-success">
                                    {{$permission->name}}
                                </span>

                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="">
                                    @role('admin|writer')
                                    <div class="btn-group" role="group">
                                        <button id="dropdownId" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Assign Role
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                            @foreach ($roles as $role)
                                            <a class="dropdown-item" href="{{route('user.assignrole',['role'=>$role->name,'user'=>$user->id])}}">{{ucfirst($role->name)}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
