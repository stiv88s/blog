<div class="row">
    <div class="col-12 justify-content-center">
        <label class="text-feader">Role Name</label>
        {!! Form::text('rolename',null,['class'=>'form-control form-group'])!!}


        <h4 class="text-center">Permissions</h4>

        <div class="custom-control custom-checkbox">
            <label class="text-feader">Check/Uncheck permissions</label>

            {!! Form::checkbox('check-all-permissions',null,  null,['class'=>'form-check-inputs','id'=>'checkall'])!!}

        </div>


        @if($errors->has('rolename'))
            <div class="alert alert-danger">
                {{$errors->first('rolename')}}
            </div>
        @endif
        <div class="">
            <table class="table table-striped  col-6 ml-auto mr-auto mt-0 mb-0">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>

                </tr>
                </thead>

                <tbody>

                @foreach($permissions as $id => $permission)
                    <tr>
                        <th scope="row">{{$id}}</th>
                        <td>
                            <div class="form-check">
                                {!! Form::checkbox('permissions[]', $id, null,['class'=>'form-check-input'])!!}
                                <label class="form-check-label" for="defaultCheck1">
                                    {{$permission}}
                                </label>
                            </div>
                        </td>

                    </tr>

                @endforeach
                </tbody>

            </table>
            <br>
        </div>

    </div>

</div>


{!! Form::submit('Save Role',['class'=>'btn btn-block btn-round btn-bold btn-primary']); !!}

@push('scripts')
    <script>
        $("#checkall").click(function(){

            $('input:checkbox').prop('checked', this.checked);
        });
    </script>
@endpush
