@component('mail::message')

@component('mail::weeklyposts',['posts'=>$posts,'token'=>$token])

@endcomponent
<br>
<footer class="bd-footer text-muted blockquote-footer">
    <div class="container-fluid p-3 p-md-5">
        <p>To unsubscribe from future updated click on: <a href="{{route('unsubscribe',[app()->getLocale(),$token])}}" target="_blank" rel="noopener">unsubscribe</a></p>
    </div>
</footer>

@endcomponent
