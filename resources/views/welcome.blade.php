@extends('layouts.user.layouts')


@section('content')
<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-8">

            <img class="img-fluid rounded" src="{{asset('img/childs.jpg')}}" alt="">

            <hr>

            <h1 class="pt-5"> Read Our Posts:</h1>

        </div>


        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">{{__('welcome.search')}}</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->

        @include('widgets.categories')
            <!-- Side Widget -->

            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
            </div>


        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    @foreach($posts as $post)
                    <div class="post-preview">
                        <a href="{{route('showing.post',[app()->getLocale(),$post,$post->slug])}}">
                            <h2 class="post-title">
                               {{$post->title}}
                            </h2>
                            <h3 class="post-subtitle">
                               {{$post->subtitle}}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by {{$post->admin->name}} on {{ $post->created_at->format('F d, Y')}}</p>

                    </div>
                    <hr>
                    @endforeach


                    <hr>

                        {{$posts->links()}}
                    <!-- Pager -->
                </div>

            </div>
        </div>

        <hr>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

@endsection
