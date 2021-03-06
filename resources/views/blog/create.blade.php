<?php
?>
@extends('layouts.base_layout')
@section('title', 'create')
@section('content')
<div class="container">
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" class="form-control" >
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
        <div class="ui-widget">
            <label for="tags">Tags </label>
            <input  name="tags" id="tags" size="50">
            <button type="button" id="addTag" class="btn-outline-primary">add tag</button>
        </div>
        <ul id="tagsList"></ul>
      <div class="form-group">
           <select name="tag[]" id="tag" multiple="multiple" class="form-control" >
              </select>
      </div>
        @error('tags')
        <p class="alert alert-warning">{{$message}}</p>
        @enderror
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input " id="customSwitch1" >
            <label class="custom-control-label" for="customSwitch1">has image</label>
        </div>
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
