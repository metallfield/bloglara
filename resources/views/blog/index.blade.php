<?php
    ?>

@extends('layouts.base_layout')
@section('title', 'home')
@section('content')
<h1 class="text-center">main page</h1>
<div class="container">
    @foreach($posts as $post)
        <h3><a href="{{route('post.show', [$post->id])}}">{{$post->name}}</a></h3>
        <span class="font-weight-bold">author :</span><a href="{{route('user.show', [$post->user->id])}}">{{$post->user->name}} </a>
        <img src="{{Storage::url($post->image)}}" alt="" height="250" class="w-100">
        <p>{{$post->content}}</p>
        @foreach($post->tags as $tag)
           <span class="badge badge-info">
               {{$tag->name}}
           </span>
        @endforeach
    @endforeach
   <div class="row my-4 justify-content-center"> {{$posts->links()}}</div>
</div>
@endsection
