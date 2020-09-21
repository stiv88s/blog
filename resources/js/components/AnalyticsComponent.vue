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
            <h3>Max Day Views for {{ analyticFor }}: <span>{{ maxViewCount }}</span></h3>
            <h3>Unique Views for {{ analyticFor }}: <span>{{ unq }}</span></h3>
            <h3>Total Views for {{ analyticFor }}: <span>{{ tot }}</span></h3>
        </div>
        <div class="text-left">
            <h2>Top Five Posts</h2>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" checked="true"
                       @change="selectType('all',0,0)">
                <label class="form-check-label" for="index">
                    all
                    <div style="display: inline-block;
                            width: 10px;
                            height: 10px;
                            background-color: #f87979;">

                    </div>
                </label>

            </div>

                <div class="form-check" v-for="(post,index) in toppostsCopy" :key="index+1">
                    <input class="form-check-input" type="checkbox" id="index" v-model="toppostsCopy[index].show"
                           @change="selectType(index+1,post.post_id,index+1)">
                    <label class="form-check-label" for="index">
                        {{ post.title }}
                        <div style="display: inline-block;" v-if="datasets[1]" :style="{width: 10+ 'px',
                            height: 10+ 'px', backgroundColor:getColors(post.post_id)}">

                        </div>
                    </label>
                </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       @change="selectType('other')" v-model="other">

                <label class="form-check-label" for="index">
                    Other
                    <div style="display: inline-block;
                            width: 10px;
                            height: 10px;
                            background-color: #7d34f4;">

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
            other:'',
            startDate: '',
            endDate: '',
            range: '',
            componentKey: 0,
            checkboxkey: 0,
            postsanalyticCopy: [],
            toppostsCopy: [],
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

            for (var i in this.postsanalyticCopy) {

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

            for (var i in this.postsanalyticCopy) {
                var searched = this.datasets.find(e => {
                    return e.id == this.postsanalyticCopy[i].post_id
                })
                if (!searched) {
                    this.datasets.push({
                        backgroundColor: this.colors[i],
                        label: this.postsanalyticCopy[i].title,
                        id: this.postsanalyticCopy[i].post_id,
                        show: false,
                        data: []

                    })
                }
            }

            for (var i in this.range.data) {

                for (var c in this.datasets) {
                    this.datasets[c].data.push(0)
                }
            }

            for (var b in this.postsanalyticCopy) {

                var date = this.postsanalyticCopy[b].date
                var index = this.range.data.indexOf(date)

                if (index === -1) {
                    continue;
                }

                this.datasets[0].data[index] += parseInt(this.postsanalyticCopy[b].not_unique)
                this.datasets.find(e => {
                    if (this.postsanalyticCopy[b].post_id == e.id) {
                        e.data[index] += parseInt(this.postsanalyticCopy[b].not_unique)

                    }

                })

            }
            // this.forceRerender()
            this.calculateViewsCount()
        },
        calculateViewsCount(type = null, dataset = null) {

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

                this.postsanalyticCopy.forEach((p) => {
                    this.tot += parseInt(p.not_unique);
                    postIdSet.add(p.user_id)
                })


            } else {
                var count = 0;
                var selectedArray = [];
                var label;
                var selectedCountViews = this.datasets.forEach((d) => {

                    if (d.show == true) {

                        count++;
                        selectedArray = selectedArray.concat(d.data)
                        label = d.label
                        this.postsanalyticCopy.find(p => {

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

                } else {
                    this.analyticFor = 'all'
                }

            }
            this.unq = postIdSet.size

        },
        selectType(type, id = null, index) {
            this.analyticFor = 'all'
            if (type == 'all') {
                this.datasets[0].show = !this.datasets[0].show
                this.calculateViewsCount(type)
            } else if (type == 'other') {
                for (var i in this.datasets) {
                    if (this.datasets[i].id == 0) {
                        continue;
                    }
                    var el = this.toppostsCopy.filter(e => {
                        return e.post_id == this.datasets[i].id
                    })

                    if (el.length == 0) {
                        this.datasets[i].show = !this.datasets[i].show
                    }


                }
                this.calculateViewsCount(type)
            } else {
                this.datasets.find(d => {
                    if (d.id == id) {
                        d.show = !d.show
                        this.calculateViewsCount(type, d)
                    }
                })
            }

            this.forceRerender()

        },
        generateColor(index) {
            // var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
            var o = Math.round, r = Math.random, s = 255;
            var randomColor = 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + 0.4 + ')';

            return randomColor;
        },
        resetDatasets() {
            this.datasets = []
            this.datasets.push({
                backgroundColor: 'rgba(255, 84, 76, 0.4)',
                label: 'all',
                id: 0,
                data: [],
                show: true
            },)
       this.other = false
            // this.datasets.forEach((e) => {
            //     e.data = []
            // })
            // this.datasets[0].data = [];
            this.unq = 0;
            this.tot = 0;

        },
        loadPostData() {
            if (this.startDate.length == 10 && this.endDate.length == 10) {

                axios.get(this.posturl + "/?startDate=" + this.startDate + "&endDate=" + this.endDate).then((response) => {
                    this.range = response.data.datarange
                    this.postsanalyticCopy = response.data.postAnalytic
                    this.fillColor()
                    // this.toppostsCopy = response.data.topPosts
                    this.calculateData()
                    this.createToppost(response.data.topPosts)





                })
            }

        },

        createToppost(posts = null) {
            this.toppostsCopy = [];
            var topposts = posts == null ? this.topposts : posts

            for (var i in topposts) {



                var dElem = this.datasets.find(d => {
                    if (d.id == topposts[i].post_id) {
                        return d;
                    }
                    // else{
                    //     if( !d.id == 0){
                    //
                    //         d.show = false
                    //     }
                    // }


                })

                if (dElem) {
                    topposts[i].show = dElem.show
                    this.$set(this.toppostsCopy, i, topposts[i])
                    // this.toppostsCopy.push(topposts[i])
                }


                //function to find element not equal datasets and toppos and make them show false
            }

            var _this=this
            var results = this.datasets.filter(function(o1) {

                return !_this.toppostsCopy.some(function (o2) {

                    return o2.post_id == o1.id;          // assumes unique id
                });
            } )
            // var results = this.datasets.filter(o1=> {
            //
            //     return this.toppostsCopy.some(o2=> {
            //
            //         return o2.post_id == o1.id;          // assumes unique id
            //     });
            // } )

            // var countingShow = 0;
            for(var e in results){
                if(results[e].id==0){
                    continue;
                }
                    // countingShow ++
                results[e].show = false



            }
            // if(countingShow>0){
            //     this.x = false
            // }
            // var f = this.toppostsCopy.some(e=>{
            //     return e.post_id>1;
            // })
            // console.log(f)

            // var result = this.datasets.filter(function(x){
            //     return this.toppostsCopy.some(function(y){
            //         return x.id==y.post_id
            //     })
            // })
            // console.log(result)


            //     // console.log(arr[f])
            //     var el = this.toppostsCopy.find(e => {
            //
            //         console.log(e.post_id != arr[f])
            //       //   console.log(103!=108)
            //       // if( e.post_id != arr[f]){
            //       //     console.log( e.post_id != arr[f])
            //       //     console.log(e.post_id)
            //       // }
            //
            //     })
            //
            //
            //     // if(el.length!=0){
            //     //     arr2.push(el)
            //     // }
            //
            //
            //
            // }

            // console.log(arr2)
            // console.log(this.toppostsCopy)

            // console.log(topposts)
           // var t = this.datasets.filter(d=>{
           //     for(var b in topposts){
           //         return d.id != topposts[b].post_id
           //     }
           // })
           //
           // console.log(t);


        },

    },

    mounted() {

        this.range = this.analyticdatarange
        this.startDate = this.startdateformat
        this.endDate = this.enddateformat
        this.analyticData = this.analyticdatarange
        this.postsanalyticCopy = this.postsanalytic
        // this.toppostsCopy = this.topposts
        this.fillColor();
        this.calculateData()
        this.calculateViewsCount('all')
        this.createToppost();

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
