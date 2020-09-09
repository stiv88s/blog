@extends('admin.layouts')

@section('content')
    <h1>
        Edit Setting
    </h1>

    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-12">
                {!! Form::model($setting,['route' => ['settings.update',app()->getLocale(),$setting],'method'=>'PATCH']) !!}



                @include('admin.settings.form')

                {!! Form::close() !!}
            </div>


        </div>
    </div>

@endsection
