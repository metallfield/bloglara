<?php
?>
@extends('layouts.base_layout')
@section('title', $post->name)
@section('content')
<h2 class="text-center">{{$post->name}}</h2>
<div class="container">
     <span class="font-weight-bold">author :</span><a href="{{route('user.show', [$post->user->id])}}">{{$post->user->name}} </a>
    <img src="{{Storage::url($post->image)}}" alt=""  height="250" class="w-100">
    @if(isset($post->tags))
        <span class="font-weight-bold">tags:</span>
@foreach($post->tags as $tag)
  <a href="{{route('tag.show', [$tag->id])}}" class="badge badge-info">{{$tag->name}}</a>
@endforeach
    @endif
    <p>{{$post->content}}</p>
</div>
@endsection
