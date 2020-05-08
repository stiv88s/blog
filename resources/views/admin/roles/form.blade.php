
<div class="row">
    <div class="col-6">

        <label class="text-feader">Role Name</label>
        {!! Form::text('rolename',null,['class'=>'form-control form-group'])!!}
        @if($errors->has('rolename'))
            <div class="alert alert-danger">
                {{$errors->first('rolename')}}
            </div>
        @endif
    </div>

</div>


{!! Form::submit('Save Tag',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

