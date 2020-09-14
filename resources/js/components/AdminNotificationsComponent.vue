<template>
</template>

<script>
export default {
    mounted(){
        Echo.private('weeklyposts')
            .listen('AdminWeeklyPostsNotificationEvent', (e) => {
                this.$toaster.success(e.message)
                console.log(e)

            });

    },

    methods: {

    },
}
</script>

<style scoped>

</style>
