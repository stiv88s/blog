<!--<template>-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-md-8">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">Example Component 2</div>-->

<!--                    <div class="card-body">-->
<!--                        I'm an example component 2 .-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<script>
    export default {
        extends: VueChartJs.Line,
        mounted() {
            this.renderChart({
                labels: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                datasets: [
                    {
                        label: 'Коммиты на GitHub',
                        backgroundColor: '#f87979',
                        data: [40, 20, 200, 39, 10, 40, 39, 80, 40, 20, 12, 11]
                    }
                ]
            }, {responsive: true, maintainAspectRatio: false})
        }
    }
</script>
