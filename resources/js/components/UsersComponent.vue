<template>
<div>
    <div class="modal fade show" style="color:red" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
<!--                    <h4 class="modal-title">You are going to block @{{username}}</h4>-->
                </div>

                <div class="modal-body">
                    <p>Please insert blocking reason below:</p>
                    <hr>
<!--                    <textarea v-model="reason" style="width: 100%">-->

<!--                        </textarea>-->
                </div>
<!--                <div class="modal-footer justify-content-between">-->
<!--                    <button type="button" class="btn btn-outline-light" data-dismiss="modal"-->
<!--                            @click.prevent="cancelModal">Cancel-->
<!--                    </button>-->
<!--                    <button type="button" class="btn btn-outline-light" @click.prevent="blockUser">Block @{{username}}</button>-->
<!--                </div>-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <table class="table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Email</td>

            <td>Actions</td>

        </tr>
        </thead>
        <tbody>

        <tr v-for="(user,index) in users" :key="index">

            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td class="float-left">
<!--                <a href="{{route('blockUser',[app()->getLocale(),$user->id])}}" @if($user->is_bloked) disabled @endif @click.stop.prevent="blockUserModal({{$user}})" href=""-->
<!--                    class="btn btn-danger">-->
<!--                    <i class="fa fa-fw fa-lock"></i>-->
<!--                </a>-->
<!--            </td>-->
<!--            <td  class="float-left" is="block-user-component" @mouseover.native="blockuser"  :user="{{json_encode($user->id)}}"></td>-->
<!--                {{route('user.edit',[app()->getLocale(),$user->id])}}-->
            <td class="float-left"><a :href=""
                                      class="btn btn-info"><i class="fa fa-fw fa-wrench"></i></a></td>
            <td class="float-left">

<!--                <a href="{{route('user.destroy',[app()->getLocale(),$user->id])}}"-->
<!--                   class="btn btn-danger removePost"><i class="fa fa-fw fa-trash"></i></a>-->

            </td>

        </tr>


        </tbody>

    </table>
</div>
</template>

<script>

    export default {
        props:['users'],
        mounted() {

        }
    }
</script>
