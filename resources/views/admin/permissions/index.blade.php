@extends('admin.layouts')

@section('content')
    <h1>
        Permissions
    </h1>

    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div id="app" class="text-center">
        <permissions-component
            applocale="{{app()->getLocale()}}"
            :permiss = "{{json_encode($permissions)}}"
        ></permissions-component>
    </div>

@endsection

