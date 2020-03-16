@extends('admin.layouts')

@section('content')
    <h1>
        Create Tag
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => 'tag.store','method'=>'POST','files'=>true]) !!}

                @include('admin.tags.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>











@endsection
