@extends('admin.layouts')

@section('content')
    <h1>
        Categories
    </h1>

    <a href="{{route('category.create')}}" class="btn btn-danger">Create Category</a>

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
                    <td class="float-left"><a href="{{route('category.edit',$cat->id)}}" class="btn btn-info">Edit</a></td>
                    <td class="float-left">
                        <a href="{{route('category.destroy',$cat->id)}}" class="btn btn-danger removeCat">Delete</a>
                    </td>
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
