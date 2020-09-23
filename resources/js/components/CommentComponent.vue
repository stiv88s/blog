<template>
    <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">{{comment.user.name}} </h5>
            <p>posted : {{comment.created_at}}</p>
            {{comment.body}}
            <div class="row pt-2">
                <div class="col-1 d-inline-block text-left">
                    <a v-if="auth" href=""><img :src="imageLikeStatus" alt="like image" width="15px" height="15px"
                                                @click.prevent="likeComment"></a>

                    <img v-if="auth==false" :src="likeImage" alt="like" width="15px" height="15px">
                    <span class="badge badge-pill">{{likeCount}}</span>
                </div>

                <div class="col-1 d-inline-block text-left">
                    <a href="" v-if="auth">
                        <img :src="imageDislikeStatus" alt="like image" width="15px" height="15px"
                             @click.prevent="dislikeComment">
                    </a>
                    <img v-if="auth==false" :src="dislikeImage" alt="dislike" width="15px" height="15px">
                    <span class="badge badge-pill">{{dislikeCount}}</span>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['comment'],
        data() {
            return {
                isliked: false,
                isdisliked: false,
                likeCount: 0,
                dislikeCount: 0,
                postid: 0,
                auth: true,
                imageLikeStatus: '/siteImages/like1.png',
                imageDislikeStatus: '/siteImages/dislike1.png',
                likeImage: '/siteImages/like1.png',
                likedImage: '/siteImages/like2.png',
                dislikeImage: '/siteImages/dislike1.png',
                dislikedImage: '/siteImages/dislike2.png',
            }
        },
        methods: {
            likeComment() {
                axios.post(route("like.post", [this.$parent.applocale, this.postid,this.comment.id] ).url(), {
                    'type': this.$parent.comment
                }).then((response) => {
                        console.log(response.data)
                        this.likeCount = response.data.likecount
                        this.dislikeCount = response.data.dislikecount
                        response.data.like == false ? this.imageLikeStatus = this.likeImage : this.imageLikeStatus = this.likedImage
                        response.data.dislike == false ? this.imageDislikeStatus = this.dislikeImage : this.imageDislikeStatus = this.dislikedImage
                        // console.log(this.imageLikeStatus)

                    }
                )

            },
            dislikeComment() {
                axios.post(route("dislike.post", [this.$parent.applocale,this.postid,this.comment.id]).url(), {
                    'type': this.$parent.comment
                }).then((response) => {
                        this.likeCount = response.data.likecount
                        this.dislikeCount = response.data.dislikecount
                        response.data.like == false ? this.imageLikeStatus = this.likeImage : this.imageLikeStatus = this.likedImage
                        response.data.dislike == false ? this.imageDislikeStatus = this.dislikeImage : this.imageDislikeStatus = this.dislikedImage

                    }
                )

            }
        },
        mounted() {

            this.isliked = this.comment.is_liked
            this.isdisliked = this.comment.is_disliked
            this.likeCount = this.comment.likes_count
            this.dislikeCount = this.comment.dislikes_count
            this.postid = this.comment.post_id
            this.auth = this.$parent.auth
            this.comment.is_liked == false ? this.imageLikeStatus = this.likeImage : this.imageLikeStatus = this.likedImage
            this.comment.is_disliked == false ? this.imageDisLikeStatus = this.dislikeImage : this.imageDislikeStatus = this.dislikedImage
        }
    }
</script>
