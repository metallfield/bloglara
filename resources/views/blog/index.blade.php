<?php
    ?>

@extends('layouts.base_layout')
@section('title', 'home')
@section('content')
<h1 class="text-center">main page</h1>
<div class="container">
    @foreach($posts as $post)
        <h3>{{$post->name}}</h3>
        <p>{{$post->content}}</p>
        @foreach($post->tags as $tag)
            {{$tag->name}}
        @endforeach
    @endforeach
</div>
@endsection
