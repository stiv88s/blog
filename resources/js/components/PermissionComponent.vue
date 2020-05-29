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
                        this.$el.parentNode.removeChild(this.$el)
                        this.$parent.permissionsForFilter.splice(this.$parent.permiss.indexOf(this.$el), 1)
                        this.$parent.permissions.splice(this.$parent.permiss.indexOf(this.$el), 1)
                    })


            }
        },

        name: "PermissionComponent"
    }
</script>

<style scoped>

</style>
