
<div class="row">
    <div class="col-6">

        <label class="text-feader">Tag Name</label>
        {!! Form::text('name',null,['class'=>'form-control form-group'])!!}
        @if($errors->has('name'))
            <div class="alert alert-danger">
                {{$errors->first('name')}}
            </div>
        @endif

        <label class="text-feader">Slug</label>
        {!! Form::text('slug',null,['class'=>'form-control form-group'])!!}


        @if($errors->has('slug'))
            <div class="alert alert-danger">
                {{$errors->first('slug')}}
            </div>
        @endif

    </div>

</div>


{!! Form::submit('Save Tag',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

