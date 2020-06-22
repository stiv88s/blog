<template>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">Analytic Posts</div>
                    <p>Start <input id="date_timepicker_start" name="startDate" v-model="startDate" type="text"
                                    value="">
                        End <input id="date_timepicker_end"
                                   v-model="endDate" name="endDate" type="text" value="">
                    </p>
<!--                    <example-component :x="y"></example-component>-->
                    <graphic-component v-if="range"  :adatarange="range" :datasetss="datasets" :key = "componentKey"></graphic-component>
                </div>
            </div>

        </div>
        <div class="float-right">
            <h3>Max Day Views : <span>{{maxViewCount}}</span></h3>
            <h3>Unique Views : <span>{{unq}}</span></h3>
            <h3>Total Views : <span>{{tot}}</span></h3>
        </div>
        <div class="text-left">
            <h2>Top Five Posts</h2>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" checked="true"
                       @change="selectType(0)">
                <label class="form-check-label" for="index">
                    all
                    <div style="display: inline-block;
                            width: 10px;
                            height: 10px;
                            background-color: #f87979;">

                    </div>
                </label>

            </div>
            <div class="form-check" v-for="(post,index) in topposts" :key="index+1">
                <input class="form-check-input" type="checkbox" value="" id="index" @change="selectType(index+1)">
                <label class="form-check-label" for="index">
                    {{post.title}}
                    <div style="display: inline-block;" :style="{width: 10+ 'px',
                            height: 10+ 'px', backgroundColor:generateColor(index+1)}">

                    </div>
                </label>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        props: ['analyticdatarange', 'startdateformat', 'enddateformat', 'applocale', 'posturl', 'topposts', 'postsanalytic'],
        data() {
            return {
                start: '',
                startDate: '',
                endDate: '',
                range: '',
                componentKey:0,
                unq: 0,
                tot: 0,
                maxViewCount: 0,
                colors:[],
                datasets: [
                    {
                        backgroundColor: '#f87979',
                        label: 'all',
                        data: [],
                        show: true
                    },
                    {
                        backgroundColor: '#f32161',
                        label: 'test',
                        data: [1, 2, 4, 5],
                        show: false
                    },
                    {
                        backgroundColor: '#f32161',
                        label: 'test2',
                        data: [1, 2, 4, 5, 6, 7],
                        show: false
                    },

                ]
            }
        },
        watch: {
            startDate: function () {

            }
        },
        methods: {
            fillColor(){
                console.log(this.generateColor())
                for(var i in this.postsanalytic){

                    // this.colors.push(`sss+dsvsdvsd`)
                }
                console.log(this.colors)
            },
            forceRerender () {
                this.componentKey += 1;
            },
            calculateData() {
                this.resetDatasets()

                for (var i in this.range.data) {
                    this.datasets[0].data.push(0)

                    for (var b in this.postsanalytic) {

                        if (this.range.data[i] == this.postsanalytic[b].date) {
                            this.datasets[0].data[i] += parseInt(this.postsanalytic[b].not_unique)
                            this.tot += parseInt(this.postsanalytic[b].not_unique);
                            this.unq += 1;

                        }

                    }

                }

                this.maxViewCount = Math.max.apply(Math, this.datasets[0].data.map(function (o) {
                    return o;
                }))
                // this.forceRerender()
            },
            selectType(type) {


                // this.datasets.map(e=>e.show = true)

                // if(type == 'all'){
                //    this.datasets[0].show =!this.datasets[0].show
                //     // this.datasets[0].show != this.this.datasets[0].show
                // }else{
                this.datasets[type].show = !this.datasets[type].show
                // this.$forceUpdate();
                console.log(this.datasets)
                this.forceRerender()

                // }
                //  this.analytic = []
                // var dataset = this.datasets.map(e=>{
                //     console.log(type)
                //     if(e.label == type){
                //         console.log(yes)
                //     }
                // })
            },
            generateColor(index) {
                var randomColor = '#'+Math.floor(Math.random()*16777215).toString(16);

                this.datasets[index].backgroundColor = randomColor;
                return randomColor;
            },
            resetDatasets() {
                this.datasets[0].data = [];
                this.unq = 0;
                this.tot = 0;

            },
            loadPostData() {
                if (this.startDate.length == 10 && this.endDate.length == 10) {

                    axios.get(this.posturl + "/?startDate=" + this.startDate + "&endDate=" + this.endDate).then((response) => {
                        this.range = response.data.datarange

                        this.calculateData()

                    })
                }

            }

        },
        mounted() {

            this.range = this.analyticdatarange
            this.startDate = this.startdateformat
            this.endDate = this.enddateformat
            this.analyticData = this.analyticdatarange
            this.fillColor();
            this.calculateData()
            // console.log(this.datasets)
            // this.analyticData.labels = this.analyticdatarange

            $(() => {
                var self = this
                $('#date_timepicker_start').datetimepicker({
                    format: 'Y/m/d',
                    timepicker: false
                }).on('change', function (e) {
                    self.startDate = $('#date_timepicker_start').val();
                    self.loadPostData();

                });
                $('#date_timepicker_end').datetimepicker({
                    format: 'Y/m/d',
                    timepicker: false
                }).on('change', function (e) {

                    self.endDate = $('#date_timepicker_end').val();
                    self.loadPostData();

                });
            });
        }

    }


</script>
