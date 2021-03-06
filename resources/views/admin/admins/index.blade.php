@extends('admin.layouts')

@section('content')
    <h1>
        Admins
    </h1>
    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <a href="{{route('admin.create',app()->getLocale())}}" class="btn btn-danger">Admin Create</a>

    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Permission</td>
                <td>Status</td>
                <td>Active to</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($admins as $admin)
                <tr>

                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>
                        @foreach($admin->roles as $role)
                            {{$role->rolename.','}}
                        @endforeach
                    </td>
                    <td>
                        @foreach($admin->roles as $role)
                            @foreach($role->permissions as $permission)
                                {{$permission->name.','}}
                            @endforeach
                        @endforeach
                    </td>
                    <td>{{$admin->status == 0 ? 'disabled' : 'active'}}</td>
                    <td>{{$admin->active_to ? $admin->active_to : ''}}</td>
                    @can('update',$admin)
                    <td class="float-left"><a href="{{route('admin.edit',[app()->getLocale(),$admin->id])}}"
                                              class="btn btn-info"><i class="fa fa-fw fa-wrench"></i></a></td>
                    @endcan
                    @can('delete',$admin)
                    <td class="float-left">

                        <a href="{{route('admin.destroy',[app()->getLocale(),$admin->id])}}"
                           class="btn btn-danger removePost"><i class="fa fa-fw fa-trash"></i></a>

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
