@extends('admin.layouts')

@section('content')
    <h1>
        Roles
    </h1>
    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @can('create',\App\Model\Role::class)
        <a href="{{route('role.create',app()->getLocale())}}" class="btn btn-danger">Create Role</a>
    @endcan
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>Id</td>
                <td>Rolename</td>
                <td>Permission</td>
                <td>Actions</td>

            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->rolename}}</td>
                    <td>

                        @foreach($role->permissions as $permission)
                            {{$permission->name.','}}
                        @endforeach

                    </td>
                    @can('update',$role)
                        <td class="float-left"><a href="{{route('role.edit',[app()->getLocale(),$role->id])}}"
                                                  class="btn btn-info">Edit</a></td>
                    @endcan
                    @can('delete',$role)
                        <td class="float-left">
                            <a href="{{route('role.destroy',[app()->getLocale(),$role->id])}}"
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
