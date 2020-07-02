<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog For everyone</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('user/externalfiles/boottem/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="{{asset('user/externalfiles/boottem/css/blog-post.css')}}" rel="stylesheet" type="text/css">
    @routes
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Blogs for everyone...</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('welcome',app()->getLocale())}}">{{__('welcome.home')}}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('welcome.about')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('welcome.services')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('welcome.contact')}}</a>
                </li>

{{--                <div class="flex-center position-ref full-height">--}}
                    @if (Route::has('user.login'))
{{--                        <div class="top-right links">--}}
                            @auth

                                <li class="nav-item">
                                    <a href="{{ route('user.home',app()->getLocale()) }}" class="nav-link">Administration</a>
                                </li>
                                <li class="nav-item">

                                        <a class="nav-link" href="{{ route('user.logout',app()->getLocale()) }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('welcome.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('user.logout',app()->getLocale()) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                </li>

                            @else
                                <li class="nav-item">
                                    <a href="{{ route('user.login',app()->getLocale()) }}" class="nav-link">{{__('welcome.login')}}</a>
                                </li>


                                @if (Route::has('user.register'))
                                    <a href="{{ route('user.register',app()->getLocale()) }}" class="nav-link">{{__('welcome.register')}}</a>
                                @endif
                            @endauth
{{--                        </div>--}}
                    @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span> {{app()->getLocale()}}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">

                        @foreach(config('app.supported_locales') as $key=>$locale)
                        <a class="dropdown-item" href="{{route('setLocale',['user',app()->getLocale(),'lang'=>$key])}}"><span class="flag-icon flag-icon-fr" > </span> {{$locale['name']}}</a>
                        @endforeach
                    </div>
                </li>
{{--                </div>--}}
            </ul>
        </div>
    </div>
</nav>

    <div class="mt-5 col-12">

        @yield('content')
    </div>


<div class="col-12 bg-danger pt-2 pb-2">

    <h2 class="text-center">Dont miss any posts updates</h2>
    <div class="row justify-content-center">
        <div class="col-12 m-2">
            @if($errors->has('email'))
                <div class="alert alert-danger">
                    {{$errors->first('email')}}
                </div>
            @endif
            <form class="form-inline justify-content-center" method="post" action="{{route('subscribe',app()->getLocale())}}">
                @csrf
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Email</label>

                    <input type="text" class="form-control" name="email" placeholder="Your email">
                </div>

                <button type="submit" class="btn btn-primary mb-2">Subscribe</button>
            </form>
        </div>

    </div>

</div>
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('/user/externalfiles/boottem/vendor/jquery/jquery.min.js')}}"></script>
<script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
{{--<script src="{{asset('/user/externalfiles/boottem/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
<script src="{{asset('js/app.js')}}"></script>
@stack('custom-scripts')

</body>

</html>
