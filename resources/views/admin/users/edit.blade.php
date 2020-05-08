@extends('admin.layouts')

@section('content')
    <h1>
        Edit Admin
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::model($user,['route' => ['user.update',app()->getLocale(),$user],'method'=>'PATCH','files'=>true]) !!}
                @include('admin.users.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>











@endsection
