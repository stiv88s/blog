<template>
    <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">{{comment.user.name}} </h5>
            <p>posted : {{comment.created_at}}</p>
            {{comment.body}}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['comment'],
        mounted() {
            console.log(this.comment)
        }
    }
</script>
