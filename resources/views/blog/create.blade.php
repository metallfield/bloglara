<?php
?>
@extends('layouts.base_layout')
@section('title', 'create')
@section('content')
<div class="container">
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        @error('name')
        <p class="alert alert-warning">{{$message}}</p>
        @enderror
     <div class="form-group">
         <label for="content">content</label>
         <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
     </div>
        @error('content')
        <p class="alert alert-warning">{{$message}}</p>
        @enderror
      <div class="form-group">
          <label for="tags">tags</label>
          <input type="text" name="tags" >
      </div>
        @error('tags')
        <p class="alert alert-warning">{{$message}}</p>
        @enderror
        <div class="form-group">
            <input id="image" type="file" class="form-controll-file" name="image" >
        </div>
        @error('image')
        <p class="alert alert-warning">{{$message}}</p>
        @enderror
<button type="submit" class="btn btn-outline-info btn-block">create</button>
        @csrf
    </form>
</div>
@endsection
