<div class="container">
    <div>
        <h1>Dear subscriber</h1>
        <p>Your weekly most popular posts :</p>
        @foreach($posts as $post)
            <a href="{{route('showing.post',[app()->getLocale(),$post->id,$post->slug])}}">{{$post->title}}</a>
        @endforeach
        <br>
    </div>
</div>
