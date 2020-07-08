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
                permissionsForFilter: [],
                search: '',
                generalPermissions:[],
                // p:[]


            }
        },
        // watch:{
        //     permissions(value){
        //         return this.gen.filter(perm => {
        //
        //             return perm.name.includes(this.search.toLowerCase())
        //         })
        //
        //         // this.permissions = this.permissionsForFilter.filter(perm=>{
        //         //     console.log(this.permissions)
        //         //     return perm.name.indexOf(value)>=0
        //         // })
        //
        //     }
        // },
        computed:{
            permissions(value){
                return this.generalPermissions.filter(perm => {
                    return perm.name.includes(this.search.toLowerCase())
                })

                // this.permissions = this.permissionsForFilter.filter(perm=>{
                //     console.log(this.permissions)
                //     return perm.name.indexOf(value)>=0
                // })

            }

        },
        methods: {
            // researchPermission(){
            //     this.permissions = this.permissionsForFilter.filter(perm=>{
            //         return perm.name.indexOf(value)>=0
            //     })
            // },
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
                            // this.p = this.p.concat(response.data)
                            // this.permissions = this.permissions.concat(response.data)
                            // this.permissionsForFilter = this.permissionsForFilter.concat(response.data)
                            this.generalPermissions = this.generalPermissions.concat(response.data)

                        }
                        this.loading = false
                    }).catch(error => {
                    this.loading = false
                })
            }
        },
        mounted() {
            // this.p = this.permiss
            // this.permissions = this.permiss
            // this.permissionsForFilter =  this.permiss

            this.generalPermissions = this.permiss
            // this.permissions =  this.gen
            // this.permissionsForFilter = this.gen
        },
        name: "PermissionsComponent"
    }
</script>

<style scoped>

</style>
