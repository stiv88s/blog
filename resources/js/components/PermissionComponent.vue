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
                        this.$parent.generalPermissions = response.data
                    })
            }
        },

        name: "PermissionComponent"
    }
</script>

<style scoped>

</style>
