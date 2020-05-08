@extends('admin.layouts')

@section('content')
    <h1>
        Admin Create
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => ['admin.store',app()->getLocale()],'method'=>'POST','files'=>true]) !!}

                @include('admin.admins.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>

@endsection
