
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
        <br>
    </div>


</div>


{!! Form::submit('Save',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

