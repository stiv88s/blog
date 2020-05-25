
<div class="row">
    <div class="col-6">

        <label class="text-feader">Permission Name</label>
        {!! Form::text('name',null,['class'=>'form-control form-group'])!!}
        @if($errors->has('name'))
            <div class="alert alert-danger">
                {{$errors->first('name')}}
            </div>
        @endif
    </div>

</div>


{!! Form::submit('Save Permission',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

