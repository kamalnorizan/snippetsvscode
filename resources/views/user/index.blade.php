@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                <span class="badge badge-pill badge-primary">
                                    {{$role->name}}
                                </span>
                                @endforeach
                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="">
                                    @role('admin|writer')
                                    <div class="btn-group" role="group">
                                        <button id="dropdownId" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Assign Role
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                            <a class="dropdown-item" href="/user/assignrole/{{$user->id}}/writer">Writer</a>
                                            <a class="dropdown-item" href="/user/assignrole/{{$user->id}}/editor">Editor</a>
                                            <a class="dropdown-item" href="/user/assignrole/{{$user->id}}/publisher">Publisher</a>
                                            <a class="dropdown-item" href="/user/assignrole/{{$user->id}}/admin">Admin</a>
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
