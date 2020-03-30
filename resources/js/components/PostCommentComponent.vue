<template>
    <div class="row">
        <div class="col-6 d-inline-block text-right">
            <a v-if="auth" href=""><img :src="imageLikeStatus" alt="like image" width="40px" height="40px"
                                        @click.prevent="likePost"></a>

            <img v-if="auth==false" :src="likeImage" alt="like" width="40px" height="40px">
            <span class="badge badge-pill">{{likeCount}}</span>
        </div>

        <div class="col-6 d-inline-block text-left">
            <a href="" v-if="auth">
                <img :src="imageDislikeStatus" alt="like image" width="40px" height="40px" @click.prevent="dislikePost">
            </a>
            <img v-if="auth==false" :src="dislikeImage" alt="dislike" width="40px" height="40px">
            <span class="badge badge-pill">{{dislikeCount}}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['isliked', 'isdisliked', 'post', 'likescount', 'dislikescount', 'postid', 'auth'],
        data() {

            return {
                authenticated: false,
                responsed: '',
                imageLikeStatus: '/siteImages/like1.png',
                imageDislikeStatus: '/siteImages/dislike1.png',
                likeImage: '/siteImages/like1.png',
                likedImage: '/siteImages/like2.png',
                likeCount: 0,
                dislikeImage: '/siteImages/dislike1.png',
                dislikedImage: '/siteImages/dislike2.png',
                dislikeCount: 0

            }

        },
        methods: {

            likePost() {
                // console.log('first '+this.imageLikeStatus)
                axios.post(route("like.post", this.postid).url(), {
                    'type': this.post
                }).then((response) => {
                        console.log(response.data)
                        this.likeCount = response.data.likecount
                        this.dislikeCount = response.data.dislikecount
                        response.data.like == false ? this.imageLikeStatus = this.likeImage : this.imageLikeStatus = this.likedImage
                        response.data.dislike == false ? this.imageDislikeStatus = this.dislikeImage : this.imageDislikeStatus = this.dislikedImage
                        console.log(this.imageLikeStatus)

                    }
                )
            },

            dislikePost() {
                // console.log('first '+this.imageDisLikeStatus)
                axios.post(route("dislike.post", this.postid).url(), {
                    'type': this.post
                }).then((response) => {
                        console.log(response.data)
                        this.likeCount = response.data.likecount
                        this.dislikeCount = response.data.dislikecount
                        response.data.like == false ? this.imageLikeStatus = this.likeImage : this.imageLikeStatus = this.likedImage
                        response.data.dislike == false ? this.imageDislikeStatus = this.dislikeImage : this.imageDislikeStatus = this.dislikedImage
                    console.log(this.imageDisLikeStatus)
                    }
                )
            }
        },
        mounted() {
            // console.log(this.dislikescount)
            this.likeCount = this.likescount
            this.dislikeCount = this.dislikescount
            this.isliked == false ? this.imageLikeStatus = this.likeImage : this.imageLikeStatus = this.likedImage
            this.isdisliked == false ? this.imageDisLikeStatus = this.dislikeImage : this.imageDislikeStatus = this.dislikedImage
        }
    }
</script>
