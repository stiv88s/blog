@extends('admin.layouts')

@section('content')
    <h1>
        Settings
    </h1>
    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @can('create',\App\Model\Settings::class)

        <a href="{{route('settings.create',app()->getLocale())}}" class="btn btn-danger">Create Setting</a>
    @endcan
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>Id</td>
                <td>Type</td>
                <td>Value</td>
                <td>Actions</td>

            </tr>
            </thead>
            <tbody>
            @foreach($settings as $setting)
                <tr>
                    <td>{{$setting->id}}</td>
                    <td>{{$setting->type}}</td>
                    <td>{{$setting->value_utc}}</td>

                    @can('update',$setting)
                        <td class="float-left"><a href="{{route('settings.edit',[app()->getLocale(),$setting->id])}}"
                                                  class="btn btn-info">Edit</a></td>
                    @endcan
                    @can('delete',$setting)
                        <td class="float-left">
                            <a href="{{route('settings.destroy',[app()->getLocale(),$setting])}}"
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
                    // console.log(data)
                    $(this).parent().parent().remove()
                }),
                error:function(err){
                   console.log(err.responseJSON.message);
                }
            })

        })
    </script>

@endpush
