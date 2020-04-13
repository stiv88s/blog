@extends('layouts.user.layouts')

@section('content')

{{--    @dd(\Illuminate\Support\Facades\Auth::user());--}}

    <div>{{\Illuminate\Support\Facades\Auth::user()->name}}</div>

 @endsection
