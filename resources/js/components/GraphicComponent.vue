<script>
    export default {
        extends: VueChartJs.Line,
        props: ['adatarange','datasetss'],
        data() {
            return {}
        },

        mounted() {
            this.startGraphic()


        },
        computed:{
            datasetsComputed(){
               return this.datasetss.filter(data=>{
                   if(data){
                       return data.show == true
                   }

                })

            }
        },
        watch: {
            adatarange(){ // watch it
                this.startGraphic()
            }
        },
        methods: {
            startGraphic() {

                this.renderChart({
                    labels: this.adatarange.range,
                    datasets:this.datasetsComputed
                    // datasets: [
                    //     {
                    //         label: 'Коммиты на GitHub',
                    //         backgroundColor: '#f87979',
                    //         data: [40, 20, 200, 100, null, null, null, 80, 40, 20, 12, 11, 40, 20, 200, 39, 10, 40, 39, 80, 40, 20, 12, 11, 40, 39, 80, 40, 20, 1]
                    //     },
                    //
                    // ]
                }, {
                    responsive: true, maintainAspectRatio: false, scales: {
                        xAxes: [{
                            ticks: {
                                max: 5,
                                min: 0,
                                autoSkip: false,
                                beginAtZero: true,
                                stepSize: 0,
                            },
                        }]
                    }
                })
            }
        }

    }
</script>
