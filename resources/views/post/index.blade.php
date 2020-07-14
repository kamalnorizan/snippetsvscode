@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            bootselect
            <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                {!! Form::label('user', 'Senarai Pengguna') !!}
                {!! Form::select('user', $options, null, ['id' => 'user', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('user') }}</small>
            </div>

            <div class="form-group{{ $errors->has('postTitle') ? ' has-error' : '' }}">
                {!! Form::label('postTitle', 'Post Title') !!}
                {!! Form::select('postTitle',$postOptions, null, ['id' => 'postTitle', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('postTitle') }}</small>
            </div>


            @foreach ($posts as $post)
            <div class="card">
                <div class="card-header">{{$post->title}} ~ {{$post->user->name}}</div>
                <div class="card-body">
                    {{$post->content}}
                </div>
                <div class="card-footer">
                    {{$post->comments->first()->user->images->path ?? ''}}
                    @foreach ($post->comments as $comment)
                    <strong>{{$comment->user->name}}</strong> ~ <small>{{\Carbon\Carbon::parse($comment->created_at)->format('d-m-Y')}}</small> <br>
                    {{$comment->comment}}
                    <hr>
                    @endforeach
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
