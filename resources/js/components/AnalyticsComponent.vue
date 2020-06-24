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

                    <graphic-component v-if="range" :adatarange="range" :datasetss="datasets"
                                       :key="componentKey"></graphic-component>
                </div>
            </div>

        </div>
        <div class="float-right">
            <h3>Max Day Views for {{analyticFor}}: <span>{{maxViewCount}}</span></h3>
            <h3>Unique Views for {{analyticFor}}: <span>{{unq}}</span></h3>
            <h3>Total Views for {{analyticFor}}: <span>{{tot}}</span></h3>
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
                <input class="form-check-input" type="checkbox" value="" id="index"
                       @change="selectType(index+1,post.post_id)">
                <label class="form-check-label" for="index">
                    {{post.title}}
                    <div style="display: inline-block;" v-if="datasets[1]" :style="{width: 10+ 'px',
                            height: 10+ 'px', backgroundColor:getColors(post.post_id)}">

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
                analyticFor: 'all',
                start: '',
                startDate: '',
                endDate: '',
                range: '',
                componentKey: 0,
                unq: 0,
                tot: 0,
                maxViewCount: 0,
                colors: [],
                datasets: [
                    {
                        backgroundColor: 'rgba(255, 84, 76, 0.4)',
                        label: 'all',
                        id: 0,
                        data: [],
                        show: true
                    },

                ]
            }
        },
        watch: {
            startDate: function () {

            }
        },
        methods: {
            fillColor() {

                for (var i in this.postsanalytic) {

                    this.colors.push(this.generateColor())
                }
            },
            forceRerender() {
                this.componentKey += 1;
            },
            getColors(postId = 0) {

                return this.datasets.find(e => {
                    if (e.id == postId) {

                        return e
                    }

                }).backgroundColor

            },
            calculateData() {
                this.resetDatasets()

                for (var i in this.postsanalytic) {
                    var searched = this.datasets.find(e => {
                        return e.id == this.postsanalytic[i].post_id
                    })
                    if (!searched) {
                        this.datasets.push({
                            backgroundColor: this.colors[i],
                            label: this.postsanalytic[i].title,
                            id: this.postsanalytic[i].post_id,
                            show: false,
                            data: []

                        })
                    }
                }

                for (var i in this.range.data) {
                    // this.datasets[0].data.push(0)
                    for (var b in this.datasets) {
                        this.datasets[b].data.push(0)
                    }
                }

                for (var b in this.postsanalytic) {

                    var date = this.postsanalytic[b].date
                    var index = this.range.data.indexOf(date)

                    if (index === -1) {
                        continue;
                    }

                    this.datasets[0].data[index] += parseInt(this.postsanalytic[b].not_unique)
                    this.datasets.find(e => {
                        if (this.postsanalytic[b].post_id == e.id) {
                            e.data[index] += parseInt(this.postsanalytic[b].not_unique)

                        }

                    })

                }
                // this.forceRerender()
                this.calculateViewsCount()
            },
            calculateViewsCount(type=null,dataset=null) {

                var index = 0;
                this.unq = 0;
                this.tot = 0;
                this.maxViewCount = 0;
                var postIdSet = new Set()
                if (this.datasets[0].show == true) {
                    this.analyticFor = 'all'
                    this.maxViewCount = Math.max.apply(Math, this.datasets[index].data.map(function (o) {
                        return o;
                    }))

                    this.postsanalytic.forEach((p) => {
                        this.tot += parseInt(p.not_unique);
                        postIdSet.add(p.user_id)
                    })


                } else {
                    var count = 0;
                    var selectedArray = [];
                    var label;
                    var selectedCountViews = this.datasets.forEach((d) => {

                        if (d.show == true) {
                            console.log(d)

                            count++;
                            selectedArray = selectedArray.concat(d.data)
                            label = d.label
                            this.postsanalytic.find(p => {

                                if (d.id == p.post_id) {
                                    postIdSet.add(p.user_id)
                                    this.tot += parseInt(p.not_unique);
                                }
                            })
                            this.maxViewCount = Math.max.apply(Math, selectedArray.map(function (o) {
                                return o;
                            }))

                        }

                    })

                    if (count == 1) {
                        this.analyticFor = label

                    }else{
                        this.analyticFor = 'all'
                    }

                }
                this.unq = postIdSet.size

            },
            selectType(type, id = null) {
                this.analyticFor = 'all'
                if (type == 0) {
                    this.datasets[type].show = !this.datasets[type].show
                    this.calculateViewsCount(type)
                } else {
                    this.datasets.find(d => {
                        if (d.id == id) {
                            d.show = !d.show
                            this.calculateViewsCount(type,d)
                        }
                    })
                }


                // this.datasets[type].show = !this.datasets[type].show
                this.forceRerender()

            },
            generateColor(index) {
                // var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                var o = Math.round, r = Math.random, s = 255;
                var randomColor = 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + 0.4 + ')';

                return randomColor;
            },
            resetDatasets() {
                this.datasets.forEach((e) => {
                    e.data = []
                })
                // this.datasets[0].data = [];
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
            this.calculateViewsCount('all')
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
