<?php
?>
@extends('layouts.base_layout')
@section('title', 'author '. $author)
@section('content')

    <div class="container">
        <h3>posts by {{$author}}</h3>
        <div class="row">
            @foreach($posts as $post)
                <div class="col border rounded p-4 m-2">
                    <h3><a href="{{route('post.show', [$post->id])}}">{{$post->name}}</a></h3>
                    <img src="{{Storage::url($post->image)}}" alt="" height="150" class="w-100">
                    <p>{{$post->content}}</p>
                </div>
            @endforeach
        </div>
        <div class="row my-4 justify-content-center">
            {{$posts->links()}}
        </div>
    </div>
@endsection
