@extends('admin.layouts')

@section('content')
    <h1>
        Posts
    </h1>
    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
@can('create',\App\Model\Post::class)
    <a href="{{route('post.create',app()->getLocale())}}" class="btn btn-danger">Create Post</a>
@endcan
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

                    <td class="float-left"><a href="{{route('post.show',[app()->getLocale(),$post])}}" class="btn btn-success">Show</a></td>
                    @can('update',$post)
                    <td class="float-left"><a href="{{route('post.edit',[app()->getLocale(),$post->id])}}" class="btn btn-info"><i class="fa fa-fw fa-wrench"></i></a></td>
                    @endcan
                    @can('delete',$post)
                    <td class="float-left">

                        <a href="{{route('post.destroy',[app()->getLocale(),$post->id])}}" class="btn btn-danger removePost"><i class="fa fa-fw fa-trash"></i></a>

                    </td>
                    @endcan
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
