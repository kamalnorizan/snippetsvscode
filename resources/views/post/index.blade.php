@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post)
            <div class="card">
                <div class="card-header">{{$post->id}}-{{$post->title}}</div>
                <div class="card-body">
                    {{$post->content}}
                </div>
                <div class="card-footer">
                    @foreach ($post->comments as $comment)
                        <strong>{{$comment->user->name}}</strong> ~ {{\Carbon\Carbon::parse($comment->created_at)->format('d-m-Y')}} <br>
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

