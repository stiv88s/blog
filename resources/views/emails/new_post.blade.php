@component('mail::message')
    Dear Subscriber
        We have new Post for you:

@component('mail::postcreated',[ 'post'=>$post, 'token'=> $token ])

@endcomponent

@endcomponent

