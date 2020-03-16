@extends('admin.layouts')

@section('content')
    <h1>
        Edit Post
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::model($post,['route' => ['post.update',$post],'method'=>'PATCH','files'=>true]) !!}

                @include('admin.posts.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>

@endsection
