@extends('admin.layouts')

@section('content')
    <h1>
        Create Post
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => ['post.store',app()->getLocale()],'method'=>'POST','files'=>true]) !!}

                @include('admin.posts.form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
