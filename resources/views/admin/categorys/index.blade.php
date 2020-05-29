@extends('admin.layouts')

@section('content')
    <h1>
        Categories
    </h1>

    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @can('create',\App\Model\Category::class)
    <a href="{{route('category.create',app()->getLocale())}}" class="btn btn-danger">Create Category</a>
    @endcan
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Tag</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $cat)
                <tr>
                    <td>{{$cat->id}}</td>
                    <td>{{$cat->name}}</td>
                    <td>{{$cat->tag}}</td>
                    @can('update',$cat)
                    <td class="float-left"><a href="{{route('category.edit',[app()->getLocale(),$cat->id])}}" class="btn btn-info">Edit</a></td>
                    @endcan
                    @can('delete',$cat)

                    <td class="float-left">
                        <a href="{{route('category.destroy',[app()->getLocale(),$cat->id])}}" class="btn btn-danger removeCat">Delete</a>
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
        $('.removeCat').on('click', function (e) {
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
