<template>
    <tr>
        <td>{{permission.id}}</td>
        <td>{{permission.name}}</td>
        <td class="float-left" v-if="this.$parent.checkPermission('permission_update')">
            <a :href="route('permission.edit',[this.$parent.applocale,permission.id])"
               class="btn btn-info">Edit
            </a>
        </td>
        <td class="float-left" v-if="this.$parent.checkPermission('permission_delete')">
            <button class="btn btn-danger" @click="destroyPermission">Delete</button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['permission'],
        methods: {
            destroyPermission() {
                console.log(this.$parent.gen)
                axios.delete(route('permission.destroy', [this.$parent.applocale, this.permission.id]).url())
                    .then((response) => {
                        // console.log(response)
                        this.$parent.generalPermissions = response.data
                        // this.$parent.permissions = response.data
                        // this.$parent.permissionsForFilter = response.data


                        // this.$el.parentNode.removeChild(this.$el)
                        // if(this.$parent.searchPermissions.length>=1){
                        //     console.log('here')
                        //     this.$parent.gen.splice(this.$parent.gen.indexOf(this.permission), 1)
                        //     this.$el.parentNode.removeChild(this.$el)
                        // }else{
                        //
                        //     console.log(this.permission)
                        //     console.log(this.$parent.gen.indexOf(this.permission))
                        //
                        //     this.$parent.gen.splice(this.$parent.gen.indexOf(this.permission), 1)

                        // }
                        // this.$parent.permissions.splice(this.$parent.permissions.indexOf(this.permission), 1)
                        // this.$parent.gen.splice(this.$parent.gen.indexOf(this.permission), 1)
                        // this.$el.parentNode.removeChild(this.$el)

                        // this.$parent.researchPermission();
                        // this.$parent.permissionsForFilter.splice(this.$parent.permissionsForFilter.indexOf(this.permission), 1)

                        // this.$parent.permissions = this.$parent.permissionsForFilter



                        // this.$parent.permissionsForFilter.splice(this.$parent.permissionsForFilter.indexOf(this.permission), 1)
                        // this.$parent.permissions.splice(this.$parent.permissions.indexOf(this.permission), 1)

                        // this.$parent.p.splice(this.$parent.p.indexOf(this.permission), 1)
                        // this.$parent.permissions.splice(this.$parent.permiss.indexOf(this.permission), 1)
                        // this.$parent.permissionsForFilter.splice(this.$parent.permissionsForFilter.indexOf(this.$el), 1)
                        // this.$parent.permissions.splice(this.$parent.permiss.indexOf(this.$el), 1)
                    })


            }
        },

        name: "PermissionComponent"
    }
</script>

<style scoped>

</style>
