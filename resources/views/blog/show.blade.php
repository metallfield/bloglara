<?php
?>
@extends('layouts.base_layout')
@section('title', $post->name)
@section('content')
<h2 class="text-center">{{$post->name}}</h2>
<div class="container">
    @if(isset($post->tags))
        <span class="font-weight-bold">tags:</span>
@foreach($post->tags as $tag)
   <span> {{$tag->name}}</span>
@endforeach
    @endif
    <p>{{$post->content}}</p>
</div>
@endsection
