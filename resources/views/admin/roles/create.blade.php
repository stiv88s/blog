@extends('admin.layouts')

@section('content')
    <h1>
        Create Role
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => ['role.store',app()->getLocale()],'method'=>'POST','files'=>true]) !!}

                @include('admin.roles.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>











@endsection
