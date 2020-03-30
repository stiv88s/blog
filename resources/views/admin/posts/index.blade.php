@extends('admin.layouts')

@section('content')
    <h1>
        Posts
    </h1>

    <a href="{{route('post.create')}}" class="btn btn-danger">Create Post</a>

    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>Id</td>
                <td>Title</td>
                <td>Slug</td>
                <td>IsActive</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>

                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    <td>{{$post->is_active}}</td>
                    <td class="float-left"><a href="{{route('post.show',$post)}}" class="btn btn-success">Show</a></td>
                    <td class="float-left"><a href="{{route('post.edit',$post->id)}}" class="btn btn-info"><i class="fa fa-fw fa-wrench"></i></a></td>
                    <td class="float-left">

                        <a href="{{route('post.destroy',$post->id)}}" class="btn btn-danger removePost"><i class="fa fa-fw fa-trash"></i></a>

                    </td>
                </tr>


            @endforeach

            </tbody>

        </table>


    </div>

@endsection

@push('scripts')

    <script>
        $('.removePost').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'DELETE',
                url: url,
                success: ((data) => {
                    console.log(data)
                    $(this).parent().parent().remove()
                })
            })

        })
    </script>

@endpush
