@extends('admin.layouts')

@section('content')
    <h1>
        Blocked Users
    </h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <td>User Name</td>
                <td>Admin Name</td>
                <td>Reason</td>
                <td>Date</td>
                <td>Unblock</td>
            </tr>
            </thead>
            <tbody>
            @foreach($blockedUsers as $blocked)
                <tr>
                    <td>{{$blocked->user->id}}</td>
                    <td>{{$blocked->user->name}}</td>
                    <td>{{$blocked->admin->name}}</td>
                    <td>{{$blocked->reason}}</td>
                    <td>{{$blocked->created_at}}</td>
                    <td class="float-left">
                        <input type="checkbox" @if($blocked->user->is_blocked == 1) checked
                               @endif  class="form-check-input unblock"
                               data-url="{{route('unblockUser',[app()->getLocale(),$blocked->user->id])}}">
                    </td>
                </tr>

            @endforeach

            </tbody>

        </table>


    </div>

@endsection

@push('scripts')

    <script>
        $(".unblock").change(function () {
            var url = $(this).attr('data-url');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: url,
                success: ((data) => {
                    $(this).parent().parent().remove()
                }),
            })
        });

    </script>

@endpush

