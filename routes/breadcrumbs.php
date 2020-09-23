<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('welcome'));
});

Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('home');
    $trail->push($category->name, route('show.categories.posts',[app()->getLocale(), $category,$category->slug]));
});

Breadcrumbs::for('post', function ($trail, $post,$category) {
    $trail->parent('category', $category);
    $trail->push($post->title, route('showing.post', [app()->getLocale(),$category,$post,$post->slug]));
});




