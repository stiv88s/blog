<template>
    <tr>
        <td>{{permission.id}}</td>
        <td>{{permission.name}}</td>
        <td class="float-left">
            <a :href="route('permission.edit',[this.$parent.applocale,permission.id])"
               class="btn btn-info">Edit
            </a>
        </td>
        <td class="float-left">
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
                    .then((response) => this.$el.parentNode.removeChild(this.$el))
            }
        },

        name: "PermissionComponent"
    }
</script>

<style scoped>

</style>
