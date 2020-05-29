@extends('admin.layouts')

@section('content')
    <h1>
        Tags
    </h1>

    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @can('create',\App\Model\Tag::class)
        <a href="{{route('tag.create',app()->getLocale())}}" class="btn btn-danger">Create Tag</a>
    @endcan
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>N</td>
                <td>Name</td>
                <td>Slug</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->slug}}</td>
                    @can('update',$tag)
                        <td class="float-left"><a href="{{route('tag.edit',[app()->getLocale(),$tag->id])}}"
                                                  class="btn btn-info">Edit</a></td>
                    @endcan
                    @can('delete',$tag)
                        <td class="float-left">
                            <a href="{{route('tag.destroy',[app()->getLocale(),$tag->id])}}"
                               class="btn btn-danger removeTag">Delete</a>
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
        $('.removeTag').on('click', function (e) {
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
