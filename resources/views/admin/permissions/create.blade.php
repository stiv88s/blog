@extends('admin.layouts')

@section('content')
    <h1>
        Create Permission
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => ['permission.store',app()->getLocale()],'method'=>'POST','files'=>true]) !!}

                @include('admin.permissions.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>











@endsection
