<div class="card my-4">
    <h5 class="card-header">{{__('welcome.categories')}}</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">


                <ul class="list-unstyled mb-0">
                    @foreach($categories as $cat)
                    <li>
                        <a href="{{route('show.categories.posts',[$cat,$cat->slug])}}">{{$cat->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
