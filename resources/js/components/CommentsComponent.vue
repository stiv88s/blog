<template>
    <div>
        <div class="card my-4" v-if="auth">
            <h5 class="card-header">Leave a Comment:</h5>

            <div class="card-body">
                <div v-if="validationErrors" v-for="(error,index) in validationErrors.body" :key="index" class="alert-danger">

                    {{error}}
                </div>
                <form @submit.prevent="saveComment" >
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="body" v-model="body"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="media mb-4">
            <div class="media-body">

                <comment-component v-for="(value,index) in commentsData.data" :key="value.id"
                                   :comment="value"
                ></comment-component>

                <pagination :data="commentsData" @pagination-change-page="getResults"></pagination>

            </div>
        </div>
    </div>

</template>

<script>
    import CommentComponent from '../components/CommentComponent.vue';

    export default {
        props: ['comments', 'postid', 'postslug','applocale','auth','comment','categoryslug'],

        data() {
            return {
                commentsData: {},
                body: '',
                validationErrors:''
            }
        },
        methods: {
            saveComment() {
                axios.post(route("store.comment", [this.applocale, this.postid]).url(), {
                    'body': this.body

                }).then((e) => {
                    console.log(e)
                    this.commentsData.data.unshift(e.data)
                    this.body = ''
                }).catch(error => {
                    if (error.response.status == 422){
                        this.validationErrors = error.response.data.errors;
                        console.log(this.validationErrors)
                    }
                })
            },
            getResults(page = 1) {
                axios.get("/"+this.applocale+"/"+this.categoryslug+"/post/" + this.postid + "-" + this.postslug + "?page=" + page)
                    .then(response => {
                        this.commentsData = response.data
                    });
                // axios.get("/"+this.applocale+"/"+this.category.id+"/post/" + this.postid + "-" + this.postslug + "?page=" + page)
                //     .then(response => {
                //         this.commentsData = response.data
                //         // this.laravelData = response.data;
                //     });
            }

        },
        mounted() {
            this.commentsData = this.comments
        },
        components: {
            'comment-component': CommentComponent
        }
    }
</script>
