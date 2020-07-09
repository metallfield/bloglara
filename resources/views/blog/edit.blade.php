<?php
?>
@extends('layouts.base_layout')
@section('title', 'edit '.$post->name)
@section('content')
    <div class="container">
        <form action="{{route('post.update', [$post->id])}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" class="form-control" required value="{{old('name' , isset($post) ? $post->name : null)}}">
            </div>

            <div class="form-group">
                <label for="content">content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">
                    {{old('name' , isset($post) ? $post->content : null)}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="tags">tags</label>
                <input type="text" name="tags" value="@foreach($post->tags as $tag) {{$tag->name}}, @if ($loop->last)  @endif @endforeach">
            </div>
            <div class="form-group">
                <input id="image" type="file" class="form-controll-file" name="image" >
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">create</button>
            @csrf
        </form>
    </div>
@endsection
