@extends('admin.layouts')

@section('content')
    <h1>
        Edit Permission
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::model($permission,['route' => ['permission.update',app()->getLocale(),$permission],'method'=>'PATCH','files'=>true]) !!}



                @include('admin.permissions.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>

@endsection
