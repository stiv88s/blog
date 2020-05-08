@extends('admin.layouts')

@section('content')
    <h1>
        Edit Admin
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::model($admin,['route' => ['admin.update',app()->getLocale(),$admin],'method'=>'PATCH','files'=>true]) !!}
                @include('admin.admins.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>











@endsection
