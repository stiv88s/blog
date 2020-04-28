@extends('admin.layouts')

@section('content')
    <h1>
       Edit Category
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::model($tag,['route' => ['tag.update',app()->getLocale(),$tag],'method'=>'PATCH','files'=>true]) !!}



                @include('admin.tags.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>

@endsection
