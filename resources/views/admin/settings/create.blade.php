@extends('admin.layouts')

@section('content')
    <h1>
        Create Setting
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::open(['route' => ['settings.store',app()->getLocale()],'method'=>'POST']) !!}

                @include('admin.settings.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>











@endsection
