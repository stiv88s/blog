@extends('admin.layouts')

@section('content')
    <h1>
       Edit Category
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::model($category,['route' => ['category.update',app()->getLocale(),$category],'method'=>'PATCH','files'=>true]) !!}



                @include('admin.categorys.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>











@endsection
