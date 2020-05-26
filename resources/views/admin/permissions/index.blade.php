@extends('admin.layouts')

@section('content')
    <h1>
        Permissions
    </h1>

    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div id="app" class="text-center">
        <permissions-component
            applocale="{{app()->getLocale()}}"
            :permiss = "{{json_encode($permissions)}}"
        ></permissions-component>
    </div>

{{--    <a href="{{route('permission.create',app()->getLocale())}}" class="btn btn-danger">Create Permission</a>--}}
{{--    <form action="{{route('generatePermission',app()->getLocale())}}" method="post" class="mt-2">--}}
{{--        @csrf--}}

{{--        <div class="input-group-append">--}}
{{--            <input type="submit" class="btn btn-outline-success" value="Generate Permission">--}}
{{--        </div>--}}

{{--    </form>--}}

{{--    <div class="card-body">--}}
{{--        <table class="table">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <td>Id</td>--}}
{{--                <td>Permission name</td>--}}
{{--                <td>Actions</td>--}}

{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($permissions as $permission)--}}
{{--                <tr>--}}
{{--                    <td>{{$permission->id}}</td>--}}
{{--                    <td>{{$permission->name}}</td>--}}
{{--                    <td class="float-left"><a href="{{route('permission.edit',[app()->getLocale(),$permission->id])}}"--}}
{{--                                              class="btn btn-info">Edit</a></td>--}}
{{--                    <td class="float-left">--}}
{{--                        <a href="{{route('permission.destroy',[app()->getLocale(),$permission->id])}}"--}}
{{--                           class="btn btn-danger removePermission">Delete</a>--}}
{{--                    </td>--}}
{{--                </tr>--}}


{{--            @endforeach--}}

{{--            </tbody>--}}

{{--        </table>--}}


{{--    </div>--}}

@endsection

{{--@push('scripts')--}}

{{--    <script>--}}
{{--        $('.removePermission').on('click', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var url = $(this).attr('href');--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}

{{--            $.ajax({--}}
{{--                type: 'DELETE',--}}
{{--                url: url,--}}
{{--                success: ((data) => {--}}
{{--                    console.log(data)--}}
{{--                    $(this).parent().parent().remove()--}}
{{--                })--}}
{{--            })--}}

{{--        })--}}
{{--    </script>--}}

{{--@endpush--}}
