<div class="row">
    <div class="col-12 justify-content-center">
        <label class="text-feader">Setting Type</label>
        {!! Form::text('type',null,['class'=>'form-control form-group'])!!}

        @if($errors->has('type'))
            <div class="alert alert-danger">
                {{$errors->first('type')}}
            </div>
        @endif

    </div>

    <div class="col-12 justify-content-center">
        {{Form::label('days', 'Select Days')}}
        @if($errors->has('days'))
            <div class="alert alert-danger">
                {{$errors->first('days')}}
            </div>
        @endif
        {{Form::select('days',$days,null,array('multiple'=>'multiple','name'=>'days[]', 'class'=>'selectpicker'))}}

        <br>

    </div>

    <div class="col-12 justify-content-center">
        <label class="text-feader">Setting Value</label>
        {!! Form::text('value_utc',null,['class'=>'form-control datetimepicker form-group','id'=>'date'])!!}

        @if($errors->has('value_utc'))
            <div class="alert alert-danger">
                {{$errors->first('value_utc')}}
            </div>
        @endif

    </div>
</div>

{{--@push('style')--}}
{{--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
{{--    <link rel="stylesheet"--}}
{{--          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css">--}}
{{--@endpush--}}

{!! Form::submit('Save Setting',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

{{--@push('scripts')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>--}}
{{--    <script--}}
{{--        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>--}}

{{--    <script>--}}
{{--        // $( document ).ready(function() {--}}
{{--        //    console.log( moment.tz.guess())--}}
{{--        // });--}}
{{--        $('#date').bootstrapMaterialDatePicker({format: 'HH:mm', date: false});--}}
{{--    </script>--}}
{{--@endpush--}}
