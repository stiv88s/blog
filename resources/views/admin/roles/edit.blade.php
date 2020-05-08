@extends('admin.layouts')

@section('content')
    <h1>
        Edit Role
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::model($role,['route' => ['role.update',app()->getLocale(),$role],'method'=>'PATCH','files'=>true]) !!}



                @include('admin.roles.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>

@endsection
