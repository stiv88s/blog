@extends('layouts.user.layouts')

@section('content')

    <div class="col-12">
        <h1>Your Liked Posts</h1>
        <hr>

        @foreach($likedPosts as $postCollection)

            @foreach($postCollection->posts as $post)
                <div>
                    <a href="{{route('showing.post',[app()->getLocale(),$post->categorys->first()->slug,$post,$post->slug])}}">{{$post->title}}</a>

                </div>
                <br>

            @endforeach


        @endforeach
        <br>
    </div>



@endsection
