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
                <input type="text" name="name" class="form-control" value="{{old('name' , isset($post) ? $post->name : null)}}">
            </div>
            @error('name')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="content">content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">
                    {{old('content' , isset($post) ? $post->content : null)}}
                </textarea>
            </div>
            @error('content')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="tags">tags</label>
                <input type="text" name="tags" value="@foreach($post->tags as $tag) {{$tag->name}}, @if ($loop->last)  @endif @endforeach">
            </div>
            @error('tags')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1">has image</label>
            </div>
            <div class="form-group image">
                <input id="image" type="file" class="form-controll-file" name="image" >
            </div>
            <script>
               var img = $('#customSwitch1').prop('checked');
                    if(img === false)
                    {
                        $('div.image').html(  '<input id="image" type="file" class="form-controll-file" name="image" >')
                    }
            </script>
            @error('image')
            <p class="alert alert-warning">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-outline-info btn-block">update</button>
            @csrf
        </form>
    </div>
@endsection
