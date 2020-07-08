<?php
    ?>

@extends('layouts.base_layout')
@section('title', 'home')
@section('content')
<h1 class="text-center">main page</h1>
<div class="container">
    @foreach($posts as $post)
        <h3><a href="{{route('post.show', [$post->id])}}">{{$post->name}}</a></h3>
        <p>{{$post->content}}</p>
        @foreach($post->tags as $tag)
           <span class="badge badge-info">
               {{$tag->name}}
           </span>
        @endforeach
    @endforeach
</div>
@endsection
