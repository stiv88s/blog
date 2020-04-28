@extends('admin.layouts')

@section('content')
    <h1>
        Create Category
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => ['category.store',app()->getLocale()],'method'=>'POST','files'=>true]) !!}

                @include('admin.categorys.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>

@endsection
