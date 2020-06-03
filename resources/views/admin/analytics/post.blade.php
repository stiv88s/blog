@extends('admin.layouts')

@section('content')

    <div class="col-12" id="app">
        <example-component></example-component>
        <br>
        <example-component></example-component>
            <h1>News all views</h1>
{{--        <canvas id="myChart"></canvas>--}}
    </div>

<p>ANalytic</p>
    <p>Start <input id="date_timepicker_start" type="text" value="">  End <input id="date_timepicker_end" type="text" value=""></p>
@endsection


<script>
    // window.onload = function() {
    //     createGraph()
    // }
    // function createGraph(){
    //     var ctx = document.getElementById('myChart').getContext('2d');
    //     console.log(ctx);
    //     var chart = new Chart(ctx, {
    //         // The type of chart we want to create
    //         type: 'line',
    //
    //         // The data for our dataset
    //         data: {
    //             labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September'],
    //             datasets: [{
    //                 label: 'My First dataset',
    //                 backgroundColor: 'rgb(255, 99, 132,0.5)',
    //                 borderColor: 'rgb(255, 99, 132)',
    //                 data: [11, 10, 5, 2, 20, 30, 45,100,10]
    //             },
    //                 {
    //                     label: 'My Second dataset',
    //                     backgroundColor: 'rgb(146, 95, 134,0.5)',
    //                     borderColor: 'rgb(155, 99, 132)',
    //                     data: [20, 67, 5, 56, 50, 3, 45,10,1]
    //                 }
    //
    //             ]
    //         },
    //
    //         // Configuration options go here
    //         options: {}
    //     });
    //
    // }



</script>
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
