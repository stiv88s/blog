<template>
</template>

<script>
export default {
    props:['id'],
    mounted(){
        Echo.private('weeklyposts')
            .listen('AdminWeeklyPostsNotificationEvent', (e) => {
                this.$toaster.success(e.message)
                console.log(e)

            });
        Echo.private(`post_updated.${this.id}`)
            .listen('AdminPostUpdatedEvent', (e) => {
                console.log('OOOOOOOK')
                console.log(e)
                this.$toaster.success(`your post: ${e.post.title} has been modified by ${e.adminPost}`)

            });

    },

    methods: {

    },
}
</script>

<style scoped>

</style>
