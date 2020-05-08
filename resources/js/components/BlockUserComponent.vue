<template>

    <td>
    <a href=""

        class="btn btn-danger removePost">
        <i class="fa fa-fw fa-lock">

    </i>
    </a>
    </td>
<!--    <td class="float-left">-->
<!--            lallala-->
<!--&lt;!&ndash;        <a href="{{route('user.destroy',[app()->getLocale(),$user->id])}}"&ndash;&gt;-->
<!--&lt;!&ndash;           class="btn btn-danger removePost"><i class="fa fa-fw fa-lock"></i></a>&ndash;&gt;-->

<!--    </td>-->
</template>

<script>

    export default {
        props:['user'],
        mounted() {
            console.log(this.user)
        }
    }
</script>
