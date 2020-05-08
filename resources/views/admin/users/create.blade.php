@extends('admin.layouts')

@section('content')
    <h1>
        User Create
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => ['user.store',app()->getLocale()],'method'=>'POST','files'=>true]) !!}

                @include('admin.users.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>

@endsection
