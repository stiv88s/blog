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

{{--        <form action="{{route('generatePermission',app()->getLocale())}}" method="post" class="mt-2">--}}
{{--            @csrf--}}

{{--            <div class="input-group-append">--}}
{{--                <input type="submit" class="btn btn-danger" value="Generate Permission">--}}
{{--            </div>--}}

{{--        </form>--}}
    <div class="text-center">
        <permissions-component
            :userpermis ="{{json_encode(\Illuminate\Support\Facades\Auth::user()->permissions)}}"
            applocale="{{app()->getLocale()}}"
            :permiss = "{{json_encode($permissions)}}"
        ></permissions-component>
    </div>

@endsection

