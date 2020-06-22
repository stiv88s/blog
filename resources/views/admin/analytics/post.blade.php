@extends('admin.layouts')

@section('content')

    <div class="col-12" id="app">

        <analytics-component
            :analyticDataRange="{{json_encode($dateRange)}}"
            startDateFormat="{{$startDateFormat}}"
            applocale="{{app()->getLocale()}}"
            posturl="{{route('post.analytic',app()->getLocale())}}"
            endDateFormat="{{$endDateFormat}}"
            :topPosts = "{{json_encode($topPosts)}}"
            :postsAnalytic ="{{json_encode($postsAnalytic)}}"

        ></analytics-component>
        <br>
        {{--        <analytics-component></analytics-component>--}}
        <h1>News all views</h1>
        {{--        <canvas id="myChart"></canvas>--}}
    </div>

    <p>ANalytic</p>
@endsection

@push('scripts')

    {{--    <script>--}}

    {{--         $(function(){--}}
    {{--             $('#date_timepicker_start').datetimepicker({--}}
    {{--                 format:'Y/m/d',--}}
    {{--                 onShow:function( ct ){--}}
    {{--                     this.setOptions({--}}
    {{--                         maxDate:$('#date_timepicker_end').val()?$('#date_timepicker_end').val():false--}}
    {{--                     })--}}
    {{--                 },--}}
    {{--                 timepicker:false--}}
    {{--             });--}}
    {{--             $('#date_timepicker_end').datetimepicker({--}}
    {{--                 format:'Y/m/d',--}}
    {{--                 onShow:function( ct ){--}}
    {{--                     this.setOptions({--}}
    {{--                         minDate:$('#date_timepicker_start').val()?$('#date_timepicker_start').val():false--}}
    {{--                     })--}}
    {{--                     console.log(ct);--}}
    {{--                 },--}}
    {{--                 timepicker:false--}}
    {{--             });--}}
    {{--         });--}}
    {{--    </script>--}}

@endpush
