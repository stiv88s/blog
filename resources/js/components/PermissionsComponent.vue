<template>
    <div>
        <div v-if="loading==true" style="position:fixed; left: 50%; z-index: 9; top: 50%;">

            <h3>Please wait...</h3>
            <img src="/admin/Load.svg" alt="loading">

        </div>

        <input type="text" class="form-control mb-4 col-4" placeholder="Search permission" v-model="search" aria-label="Search"
               aria-describedby="basic-addon1">

        <a :href="route('permission.create',this.applocale)"  v-if="this.checkPermission('permission_create')" class="btn btn-danger float-left">Create Permission</a>
        <button class="btn btn-outline-success" v-if="this.checkPermission('permission_create')" @click="generatePermissions">Generate Permissions</button>

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Permission name</td>
                    <td class="text-left">Actions</td>
                </tr>
                </thead>

                <tbody is="permission-component" @loadpermission="loading" class="text-center"
                       v-for="(permission,index) in permissions"
                       :key="index"
                       :permission="permission"
                ></tbody>

            </table>


        </div>

    </div>
</template>

<script>

    export default {
        props: ['applocale', 'permiss','userpermis'],
        data() {
            return {
                loading: false,
                // permissions: [],
                search: '',
                generalPermissions:[],
            }
        },

        computed:{
            permissions(value){
                return this.generalPermissions.filter(perm => {
                    return perm.name.includes(this.search.toLowerCase())
                })

            }

        },
        methods: {
            checkPermission(name) {
                if (this.userpermis[0] == 'superadmin') {
                    return true;
                }
                return this.userpermis.indexOf(name) >= 1
            },



            generatePermissions() {
                this.loading = true
                axios.post(route('generatePermission', [this.applocale]).url())

                    .then(response => {
                        if (response.data.length > 0) {
                            this.generalPermissions = this.generalPermissions.concat(response.data)

                        }
                        this.loading = false
                    }).catch(error => {
                    this.loading = false
                })
            }
        },
        mounted() {


            this.generalPermissions = this.permiss

        },
        name: "PermissionsComponent"
    }
</script>

<style scoped>

</style>
