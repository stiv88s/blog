<template>
    <div class="card-body">

        <div v-if="waiting" class="text-center">
            <img :src="loading" alt="image">
        </div>
        <form>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" v-model="email" name="email" value="" required
                           autocomplete="email" autofocus>


                    <span v-if="errors.email" class="alert-danger" role="alert">

                                        <strong>{{ errors.email[0]}}</strong>
                                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" v-model="password" name="password"
                           required
                           autocomplete="new-password">

                    <span v-if="errors.password" class="alert-danger" role="alert">
                                        <strong>{{ errors.password[0]}}</strong>
                                    </span>

                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" v-model="password_confirmation"
                           name="password_confirmation"
                           required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button class="btn btn-primary" @click="sendForm">
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['loading', 'token'],
        data() {
            return {

                errors: '',
                email: '',
                password: '',
                password_confirmation: '',
                waiting: false,
            }
        },
        mounted() {


        },

        methods: {
            sendForm(e) {
                e.preventDefault();
                this.waiting = true
                axios.post(route('admin.password.update').url(), {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    token: this.token

                }).then((response) => {
                    this.waiting = false;
                    console.log(response)
                    window.location.href = route('admin.home').url()
                })
                    .catch((errors) => {
                        console.log(errors)
                        this.waiting = false
                        this.errors = errors.response.data.errors
                        console.log(this.errors)

                    })
            }
        }
    }
</script>
