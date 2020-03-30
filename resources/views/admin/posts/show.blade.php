@extends('admin.layouts')

@section('content')
    <h1>
        Posts
    </h1>



    <div class="card-body">
        <!-- Page Content -->
            <div class="container">

                <div class="row">

                    <!-- Post Content Column -->
                    <div class="col-lg-12">

                        <!-- Title -->
                        <h1 class="mt-4">{{$post->title}}</h1>

                        <hr>

                        <!-- Date/Time -->
                        <p>Posted on {{ $post->created_at->format('F, d-Y-H:i')}}</p>

                        <hr>

                        <!-- Preview Image -->
                        <img class="img-fluid rounded" src="{{asset($post->header_image)}}" alt="image">

                        <hr>

                        <!-- Post Content -->

                        {!!$post->body!!}

                        <hr>


                    </div>
                </div>

             </div>


    </div>
                <!-- /.row -->


            <!-- /.container -->


@endsection

