<div class="container">
    <div class="col-12">
        <img src="{{asset($post->header_image)}}" class="img-fluid" alt="image">
        <br>
        <a href="{{route('showing.post',[app()->getLocale(),$post->categorys->first()->slug,$post,$post->slug])}}">{{$post->title}}</a>
    </div>
    <br>
    <p>Click <a href="{{route('unsubscribe',[app()->getLocale(), $token])}}">Here</a> to unsubscribe from future updates</p>
</div>
