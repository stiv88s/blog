<template>
</template>

<script>
export default {
    props:['id'],
    mounted(){
        Echo.private('weeklyposts')
            .listen('AdminWeeklyPostsNotificationEvent', (e) => {
                this.$toaster.success(e.message)

            });
        Echo.private(`post_updated.${this.id}`)
            .listen('AdminPostUpdatedEvent', (e) => {
                this.$toaster.success(`your post: ${e.post.title} has been modified by ${e.adminPost}`)

            });

    },

    methods: {

    },
}
</script>

<style scoped>

</style>
