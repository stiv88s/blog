@extends('adminlte::page')


@section('content')

@endsection

@push('style')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
    @if(!\Illuminate\Support\Facades\Auth::user()->timezone)
        <input type="hidden" name="timezone" class="timezone" data-url="{{route('timezone.update',app()->getLocale())}}">


        <script>
            $(document).ready(function () {
                console.log('timezone')
                var url = $('.timezone').attr('data-url')
                var data = {'timezone': moment.tz.guess()};
                if (url !== undefined) {
                    console.log('time')
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                    })
                }
            });
        </script>
    @endif
    <script>
        $('#date').bootstrapMaterialDatePicker({format: 'HH:mm', date: false});

    </script>

        @endpush






