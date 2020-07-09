<?php
?>
@extends('layouts.base_layout')
@section('title', 'tag: '.$tag->name)
@section('content')
<div class="container">
    <h2>Tag: {{$tag->name}}</h2>
    <div class="row">
        @foreach($posts as $post)
        <div class="col border rounded p-4 m-2">
            <h3><a href="{{route('post.show', [$post->id])}}">{{$post->name}}</a></h3>
            <img src="{{Storage::url($post->image)}}" alt="" height="150" class="w-100">
            <p>{{$post->content}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
