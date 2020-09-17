<div class="row">
    <div class="col-6">

        <label class="text-feader">Name</label>
        {!! Form::text('name',null,['class'=>'form-control form-group'])!!}
        @if($errors->has('name'))
            <div class="alert alert-danger">
                {{$errors->first('name')}}
            </div>
        @endif

        <label class="text-feader">Email</label>
        {!! Form::text('email',null,['class'=>'form-control form-group'])!!}


        @if($errors->has('email'))
            <div class="alert alert-danger">
                {{$errors->first('email')}}
            </div>
        @endif

        <label class="text-fader">Password</label>
        {!! Form::text('password',"", ['class'=>'form-control'])!!}
        @if($errors->has('password'))
            <span class="help-block">
                        <strong>{{($errors->first('password'))}}</strong>
                    </span>
        @endif


        <label class="text-feader">Phone</label>
        {!! Form::text('phone',null,['class'=>'form-control form-group'])!!}


        @if($errors->has('phone'))
            <div class="alert alert-danger">
                {{$errors->first('phone')}}
            </div>
        @endif

        <label class="text-feader">Status</label>
        {!! Form::text('status',null,['class'=>'form-control form-group'])!!}


        @if($errors->has('status'))
            <div class="alert alert-danger">
                {{$errors->first('status')}}
            </div>
        @endif

        {{Form::label('roles', 'Select Role')}}
        @if($errors->has('roles'))
            <div class="alert alert-danger">
                {{$errors->first('roles')}}
            </div>
        @endif
        {{Form::select('roles',$roles,null,array('multiple'=>'multiple','name'=>'roles[]', 'class'=>'selectpicker'))}}


        <br>

        {{Form::label('active_to', 'Active to:',['class'=>'pt-3'])}}
        {!! Form::text('active_to',null,['class'=>'form-control datetimepicker col-3 mb-3'])!!}


    </div>


</div>


{!! Form::submit('Save Admin',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

@push('scripts')
    <script>
        $(function () {
            //Date picker

            $('.datetimepicker').datetimepicker({
                format: 'Y-m-d H:i',
                lang: 'en'
            });
        })
    </script>
@endpush
