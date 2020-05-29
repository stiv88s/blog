@extends('admin.layouts')

@section('content')
    <h1>
        Users
    </h1>

    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @can('create',\App\Model\User::class)
    <a href="{{route('user.create',app()->getLocale())}}" class="btn btn-danger">User Create</a>
    @endcan
    <div class="card-body" id="app">
        <users-component
            :permissions ="{{json_encode(\Illuminate\Support\Facades\Auth::user()->permissions)}}"
            :users ="{{ json_encode($users)}}"
            applocale="{{app()->getLocale()}}"
        ></users-component>

    </div>

@endsection




