<template>

    <tr>

        <td>{{userMain.name}}</td>
        <td>{{userMain .email}}</td>
        <td>{{userMain .is_blocked == 1 ? 'yes' : 'no' }}</td>
        <td class="float-left" v-if="this.$parent.checkPermission('blockedusers_unblock')"><a @click.stop.prevent="unblockUser()"
                                  class="btn btn-danger" :class="{disabled:!user.is_blocked}">
            <i class="fa fa-unlock-alt"></i>
        </a></td>
        <td class="float-left" v-if="this.$parent.checkPermission('blockedusers_block')">
            <a @click.stop.prevent="blockUserModal(user)"
               class="btn btn-danger" :class="{disabled:user.is_blocked==1}">
                <i class="fa fa-fw fa-lock"></i>
            </a>
        </td>

        <td v-if="this.$parent.checkPermission('user_update')" class="float-left">
            <a :href="route('user.edit',[applocale,user.id]).url()"
               class="btn btn-info">
                <i class="fa fa-fw fa-wrench"></i>
            </a>
        </td>
        <td v-if="this.$parent.checkPermission('user_delete')" class="float-left">

            <a href="#" @click.prevent="destroyUser(user)"
               class="btn btn-danger removePost"><i class="fa fa-fw fa-trash"></i></a>

        </td>

    </tr>
</template>

<script>

    export default {
        props: ['user', 'apploc'],
        data() {
            return {
                applocale: '',
                userMain: ''
            }
        },
        mounted() {
            this.applocale = this.apploc
            this.userMain = this.user
        },
        computed: {},

        methods: {
            blockUserModal() {
                this.$emit('userBlock', this.userMain)
            },
            unblockUser(user) {
                this.$emit('userUnblock', this.userMain)
            },
            destroyUser() {
                axios.delete(route('user.destroy', [this.applocale, this.userMain.id]).url())
                    .then((response) => this.$el.parentNode.removeChild(this.$el))

            }
        }
    }
</script>
