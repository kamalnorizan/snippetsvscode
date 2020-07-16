@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new user</div>

                <div class="card-body">
                   {!! Form::open(['method' => 'POST', 'route' => 'user.store']) !!}

                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           {!! Form::label('name', 'Nama') !!}
                           {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                           <small class="text-danger">{{ $errors->first('name') }}</small>
                       </div>
                       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           {!! Form::label('email', 'Email address') !!}
                           {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
                           <small class="text-danger">{{ $errors->first('email') }}</small>
                       </div>
                       <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                           {!! Form::label('password', 'Password') !!}
                           {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                           <small class="text-danger">{{ $errors->first('password') }}</small>
                       </div>

                       <div class="btn-group pull-right">

                           {!! Form::submit("Tambah", ['class' => 'btn btn-success']) !!}
                       </div>

                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

