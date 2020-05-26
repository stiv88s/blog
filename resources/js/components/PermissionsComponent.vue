<template>
    <div>
        <div v-if="loading==true" style="position:fixed; left: 50%; z-index: 9; top: 50%;">

            <h3>Please wait...</h3>
            <img src="/admin/Load.svg" alt="loading">

        </div>
        <a :href="route('permission.create',this.applocale)" class="btn btn-danger float-left">Create Permission</a>
        <button class="btn btn-outline-success" @click="generatePermissions">Generate Permissions</button>

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Permission name</td>
                    <td class="text-left">Actions</td>
                </tr>
                </thead>

                <tbody is="permission-component" @loadpermission="loading" class="text-center" v-for="(permission,index) in permissions"
                       :key="index"
                       :permission="permission"
                ></tbody>

            </table>


        </div>

    </div>
</template>

<script>

    export default {
        props: ['applocale', 'permiss'],
        data() {
            return {
                loading:false,
                permissions: [],

            }
        },
        methods: {
            generatePermissions() {
                this.loading = true
                axios.post(route('generatePermission', [this.applocale]).url())

                    .then(response => {
                        if (response.data.length > 0) {
                            this.permissions = this.permissions.concat(response.data)
                        }
                        this.loading = false
                    }).catch(error => {
                           this.loading = false
                       })
            }
        },
        mounted() {
            this.permissions = this.permiss
        },
        name: "PermissionsComponent"
    }
</script>

<style scoped>

</style>
