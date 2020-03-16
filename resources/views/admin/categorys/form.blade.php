
<div class="row">
    <div class="col-6">

        <label class="text-feader">Name</label>
        {!! Form::text('name',null,['class'=>'form-control form-group'])!!}
        @if($errors->has('name'))
            <div class="alert alert-danger">
                {{$errors->first('name')}}
            </div>
        @endif

        <label class="text-feader">Tag</label>
        {!! Form::text('tag',null,['class'=>'form-control form-group'])!!}


        @if($errors->has('tag'))
            <div class="alert alert-danger">
                {{$errors->first('tag')}}
            </div>
        @endif

    </div>

</div>


{!! Form::submit('Save Category',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

<script>
    $(document).ready(function() {
                $('#summernote').summernote();
       })
</script>
