
<div class="row">
    <div class="col-6">

        <label class="text-feader">Post Title</label>
        {!! Form::text('title',null,['class'=>'form-control form-group'])!!}

        @if($errors->has('title'))
            <div class="alert alert-danger">
                {{$errors->first('title')}}
            </div>
        @endif

        <label class="text-feader">Subtitle</label>
        {!! Form::text('subtitle',null,['class'=>'form-control form-group'])!!}

        @if($errors->has('subtitle'))
            <div class="alert alert-danger">
                {{$errors->first('subtitle')}}
            </div>
        @endif

        <label class="text-feader">Slug</label>
        {!! Form::text('slug',null,['class'=>'form-control form-group'])!!}

        @if($errors->has('slug'))
            <div class="alert alert-danger">
                {{$errors->first('slug')}}
            </div>
        @endif

        <label class="text-feader">Is Active ?</label>
        <br>
        {!! Form::checkbox('is_active',1,false,['class'=>'form-group'])!!}

        @if($errors->has('is_active'))
            <div class="alert alert-danger">
                {{$errors->first('is_active')}}
            </div>
        @endif


    </div>
    <div class="col-6">

        <label class="text-feader">Header Image</label>
        {!! Form::file('header_image',null,['class'=>'form-control form-group',])!!}

        <br>

        @if($errors->has('header_image'))
            <div class="alert alert-danger">
                {{$errors->first('header_image')}}
            </div>
        @endif

        <label>Body</label>

        {!! Form::textarea('body',null,['id'=>'summernote','height'=>400])!!}

    </div>
</div>


{!! Form::submit('Save Post',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

<script>
    $(document).ready(function() {
                $('#summernote').summernote();
       })
</script>
