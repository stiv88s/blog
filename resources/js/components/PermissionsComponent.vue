<template>
    <div>
        <a :href="route('permission.create',this.applocale)" class="btn btn-danger float-left">Create Permission</a>
        <br>
        <!--        <form action="{{route('generatePermission',app()->getLocale())}}" method="post" class="mt-2">-->
        <!--            @csrf-->

        <!--            <div class="input-group-append">-->
        <!--                <input type="submit" class="btn btn-outline-success" value="Generate Permission">-->
        <!--            </div>-->

        <!--        </form>-->

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Permission name</td>
                    <td class="text-left">Actions</td>
                </tr>
                </thead>

<!--                <tbody>-->
                    <tbody is="permission-component" class="text-center" v-for="(permission,index) in permissions"
                        :key="index"
                        :permission="permission"
                    ></tbody>
                <!--                @foreach($permissions as $permission)-->
                <!--                <tr>-->
                <!--                    <td>{{$permission->id}}</td>-->
                <!--                    <td>{{$permission->name}}</td>-->
                <!--                    <td class="float-left"><a href="{{route('permission.edit',[app()->getLocale(),$permission->id])}}"-->
                <!--                                              class="btn btn-info">Edit</a></td>-->
                <!--                    <td class="float-left">-->
                <!--                        <a href="{{route('permission.destroy',[app()->getLocale(),$permission->id])}}"-->
                <!--                           class="btn btn-danger removePermission">Delete</a>-->
                <!--                    </td>-->
                <!--                </tr>-->


                <!--                @endforeach-->

<!--                </tbody>-->

            </table>


        </div>

    </div>
</template>

<script>

    export default {
        props: ['applocale', 'permiss'],
        data() {
            return {
                permissions : [],

            }
        },
        mounted() {
            this.permissions = this.permiss
            console.log(this.permiss)
        },
        name: "PermissionsComponent"
    }
</script>

<style scoped>

</style>
