<template>
    <div>
        <div v-if="err.show" class="alert-info text-center">
            {{err.message}}
        </div>
        <div class="modal fade show" style="color:red;" :style="dynamic" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">You are going to block {{username}}</h4>
                    </div>

                    <div class="modal-body">
                        <p>Please insert blocking reason below:</p>
                        <hr>
                        <textarea v-model="reason" style="width: 100%">

                                                </textarea>
                    </div>
                    <div v-if="err.show" class="alert-info text-center">
                        {{err.message}}
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal"
                                @click.prevent="cancelModal">Cancel
                        </button>
                        <button v-if="(this.reason.trim()).length > 5" type="button" class="btn btn-outline-light"
                                @click.prevent="blockUser">Block {{username}}
                        </button>
                    </div>
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

            <tr is="user-component" @userBlock="openModal" @userUnblock="unblockUser" v-for="(user,index) in userslocal"
                :key="index"
                :user="user"
                :apploc="applocal"

            ></tr>

            </tbody>

        </table>
    </div>
</template>

<script>

    import UserComponent from '../components/UserComponent.vue';

    export default {
        props: ['users', 'applocale', 'permissions'],
        data() {
            return {
                applocal: '',
                userslocal: [],
                blockeduserid: '',
                username: '',
                reason: '',
                blockreasonform: false,
                display: 'none',
                user: '',
                err: {
                    show: false,
                    message: ''
                }


            }
        },
        mounted() {
            this.applocal = this.applocale
            this.userslocal = this.users

        },
        computed: {
            dynamic() {
                return {
                    display: this.display
                }
            }
        },

        methods: {
            checkPermission(name) {
                if (this.permissions[0] == 'superadmin') {
                    return true;
                }

                return this.permissions.indexOf(name) >= 1

            },
            unblockUser(user) {
                this.user = user
                axios.post(route('unblockUser', [this.applocal, this.user.id]).url())
                    .then((response) => {
                            var user = this.userslocal.find(u => u.id == response.data.user.id)
                            user.is_blocked = 0;

                        }
                    ).catch(error => {
                    this.err.show = true
                    this.err.message = error.response.data.message
                });
            },
            openModal(user) {
                this.user = user
                this.username = user.name
                this.reason = ''
                this.blockreasonform = true
                this.display = 'block'
                this.err.show = false
                this.err.message = ''

            },
            blockUser() {
                if ((this.reason.trim()).length > 5) {
                    axios.post(route('blockUser', [this.applocal, this.user.id]).url(), {
                        reason: this.reason
                    })
                        .then((response) => {
                            this.reason = ''
                            this.display = 'none'
                            this.blockreasonform = false
                            var user = this.userslocal.find(u => u.id == response.data.user.user_id)
                            user.is_blocked = 1;
                        }).catch(error => {
                        this.err.show = true
                        this.err.message = error.response.data.message
                    });


                } else {
                    return false;
                }

            }
            ,
            cancelModal() {

                this.display = 'none'
                this.blockreasonform = false
                this.err.show = false
                this.err.message = ''
            },

        },
        components: {
            'user-component': UserComponent
        }

    }
</script>
