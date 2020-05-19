@extends('layouts.user.layouts')


@section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8 col-md-8 col-12">

                <!-- Title -->
                <h1 class="mt-4">{{$post->title}}</h1>


                <hr>

                <!-- Date/Time -->
                <p class="post-meta">Posted by {{$post->admin->name}} on {{ $post->created_at->format('F d, Y')}}</p>

                <hr>

                <!-- Preview Image -->
                @if($post->header_image)
                    <img class="img-fluid rounded" src="{{asset($post->header_image)}}" alt="images">

                @endif

                <hr>

                {!!$post->body!!}

            <!-- Post Content -->
                {!!$post->body!!}
                <hr>
                <h2 class="text-center mb-2">
                    What do you think?
                </h2>
                <hr>
                @guest
                    <div class="col-12">
                        <p>Please <span> <a href="{{ route('user.login',app()->getLocale()) }}">Login</a> </span> to leave your Vote</p>
                    </div>

                @endguest

                {{--                    <div class="row" id="app">--}}
                <div id="app">

                    <post-comment-component
                        applocale="{{app()->getLocale()}}"
                        :isliked="{{json_encode($post->isLiked())}}"
                        :isdisliked="{{json_encode($post->isDisLiked())}}"
                        auth="{{\Illuminate\Support\Facades\Auth::user() ? true:false}}"
                        post="{{\App\Model\Post::class}}"
                        :likescount="{{$post->likesCount}}"
                        :dislikescount="{{$post->dislikesCount}}"
                        postid="{{$post->id}}">

                    </post-comment-component>
                    {{--                        <div class="col-6 d-inline-block text-right">--}}
                    {{--                            <a href="{{route('like.post',[$post,\App\Model\Post::class])}}"><img src="{{asset('siteImages/like1.png')}}" alt="like image" width="40px" height="40px"></a>--}}

                    {{--                            <span class="badge badge-pill">{{$post->likes_count}}</span>--}}
                    {{--                        </div>--}}

                    {{--                        <div class="col-6 d-inline-block text-left">--}}
                    {{--                            <a href="">--}}
                    {{--                                <img src="{{asset('siteImages/dislike1.png')}}" alt="like image" width="40px" height="40px">--}}
                    {{--                            </a>--}}

                    {{--                            <span class="badge badge-pill">20</span>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}


                    <hr>
                    <h1 class="text-left text-bold">Post Tags</h1>
{{--working--}}
                    @foreach($post->tags as $tag)
                        <a href="{{route('show.tags.posts',[app()->getLocale(),$tag,$tag->slug])}}"
                           class=" btn btn-info">{{$tag->name}}</a>

                    @endforeach


                <!-- Comments Form -->
                    {{--                <div class="card my-4">--}}
                    {{--                    @auth--}}
                    {{--                   <h5 class="card-header">Leave a Comment:</h5>--}}

                    {{--                    <div class="card-body">--}}
                    {{--                        <form action="{{route('store.comment',$post)}}" method="POST">--}}
                    {{--                             @csrf--}}
                    {{--                            <div class="form-group">--}}
                    {{--                                <textarea class="form-control" rows="3" name="body"></textarea>--}}
                    {{--                            </div>--}}
                    {{--                            <button type="submit" class="btn btn-primary">Submit</button>--}}
                    {{--                        </form>--}}
                    {{--                    </div> --}}
                    {{--                    @endauth--}}

                    {{--                </div>--}}
                    @guest
                        <div class="col-12 p-3">
                            <p>Please <span> <a href="{{ route('user.login',app()->getLocale()) }}">Login</a> </span> to leave your comment</p>
                        </div>
                    @endguest

{{--                    @auth--}}
                        <comments-component
                            :comments="{{json_encode($comments)}}"
                            comment="{{\App\Model\Comment::class}}"
                            postid="{{$post->id}}"
                            applocale="{{app()->getLocale()}}"
                            postslug="{{$post->slug}}"
                            auth="{{\Illuminate\Support\Facades\Auth::user() ? true:false}}"
                        >

                        </comments-component>
{{--                    @endauth--}}
                    {{--                    @foreach($comments as $comment)--}}

                    {{--                    --}}{{--                    @foreach($post->comments as $comment)--}}
                    {{--                    <div class="media mb-4">--}}
                    {{--                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">--}}
                    {{--                        <div class="media-body">--}}
                    {{--                            <h5 class="mt-0">{{$comment->user->name}}</h5>--}}
                    {{--                            {{$comment->body}}--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    @endforeach--}}
                <!-- Single Comment -->
                    {{--                <div class="media mb-4">--}}
                    {{--                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">--}}
                    {{--                    <div class="media-body">--}}
                    {{--                        <h5 class="mt-0">Commenter Name</h5>--}}
                    {{--                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}

                    {{--                <!-- Comment with nested comments -->--}}
                    {{--                <div class="media mb-4">--}}
                    {{--                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">--}}
                    {{--                    <div class="media-body">--}}
                    {{--                        <h5 class="mt-0">Commenter Name</h5>--}}
                    {{--                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}

                    {{--                        <div class="media mt-4">--}}
                    {{--                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">--}}
                    {{--                            <div class="media-body">--}}
                    {{--                                <h5 class="mt-0">Commenter Name</h5>--}}
                    {{--                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}

                    {{--                        <div class="media mt-4">--}}
                    {{--                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">--}}
                    {{--                            <div class="media-body">--}}
                    {{--                                <h5 class="mt-0">Commenter Name</h5>--}}
                    {{--                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                </div>--}}

                </div>


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
                    <h5 class="card-header">Wheater</h5>
                    <form action="{{route('showing.post',[app()->getLocale(),$post,$post->slug])}}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="city" placeholder="Search by city" aria-label="Search by city" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </div>

                    </form>
                    <div class="card-body text-center">
                        <p><img src="http://openweathermap.org/img/wn/{{$wheather['weather'][0]['icon']}}.png" width="50px" height="50px" alt="image"></p>
                        <p><strong>City: </strong> {{$wheather['name']}}</p>
                        <p><strong>Wind: </strong>{{$wheather['wind']['speed']}} m/s</p>
                        <p><strong>Temp: </strong>{{$wheather['main']['temp'] -273.15 . ' C'}} </p>
                    </div>
                </div>
            </div>

{{--                    {{$comments->links()}}--}}
        <!-- /.row -->

        </div>
        <!-- /.container -->

@endsection
