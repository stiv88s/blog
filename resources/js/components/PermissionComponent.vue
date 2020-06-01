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
                axios.delete(route('permission.destroy', [this.$parent.applocale, this.permission.id]).url())
                    .then((response) => {
                        // console.log(this.$parent.permiss)
                        // this.$el.parentNode.removeChild(this.$el)
                        // console.log(this.$el);
                        // console.log(this.permission)
                        // console.log(this.$parent.permiss.indexOf(this));
                        // console.log(this.$parent.permissions)
                        // console.log(this.$parent.permissionsForFilter);
                        // console.log(this.$parent.permissionsForFilter.indexOf(this.permission))
                        this.$parent.permissionsForFilter.splice(this.$parent.permissionsForFilter.indexOf(this.permission), 1)
                        this.$parent.permissions.splice(this.$parent.permissions.indexOf(this.permission), 1)
                        // this.$parent.p.splice(this.$parent.p.indexOf(this.permission), 1)

                        // this.$parent.permissions.splice(this.$parent.permiss.indexOf(this.permission), 1)
                        // console.log(this.$parent.permissionsForFilter.indexOf(this.$el))
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
