@extends('admin.layouts')

@section('content')
    <h1>
        Users
    </h1>

    <a href="{{route('user.create',app()->getLocale())}}" class="btn btn-danger">User Create</a>

    <div class="card-body" id="app">
        <users-component
            :users ="{{ json_encode($users)}}"
            applocale="{{app()->getLocale()}}"
        ></users-component>

    </div>

@endsection




