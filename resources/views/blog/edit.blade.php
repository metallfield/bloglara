<?php
?>
@extends('layouts.base_layout')
@section('title', 'edit '.$post->name)
@section('content')
    <div class="container">
        <form action="{{route('post.update', [$post->id])}}" method="post">
            @method('PATCH')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" class="form-control" required value="{{old('name' , isset($post) ? $post->name : null)}}">
            </div>
            <div class="form-group">
                <label for="slug">slug</label>
                <input type="text" name="slug" class="form-control" required value="{{old('name' , isset($post) ? $post->slug : null)}}">
            </div>
            <div class="form-group">
                <label for="content">content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">
                    {{old('name' , isset($post) ? $post->content : null)}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="tags">tags</label>
                <select name="tags[]" id="tags" class="custom-select" size="4" multiple="multiple">
                    <option  >choose tags</option>
                    @foreach($tags as  $tag)

                        <option value="{{$tag->id}}"  {{$post->selectedTag($tag->id)}}>{{$tag->name}}</option>
                    @endforeach

                </select>
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">create</button>
            @csrf
        </form>
    </div>
@endsection
