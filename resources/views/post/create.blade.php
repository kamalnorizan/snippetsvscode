@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (isset($post))
                    <div class="card-header">Edit Post</div>
                @else
                    <div class="card-header">Create New Form</div>
                @endif

                <div class="card-body">
                    @if (isset($post))
                        {!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'PUT']) !!}
                    @else
                        {!! Form::open(['method' => 'POST', 'route' => 'post.store']) !!}
                    @endif

                       @include('post._form')


                    @if (isset($post))
                       {!! Form::submit("Update", ['class' => 'btn btn-success']) !!}
                    @else
                        {!! Form::submit("Post", ['class' => 'btn btn-success']) !!}
                    @endif



                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

