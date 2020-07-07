<?php
?>
@extends('layouts.base_layout')
@section('title', 'create')
@section('content')
<div class="container">
    <form action="{{route('post.store')}}" method="post">
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="slug">slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>
     <div class="form-group">
         <label for="content">content</label>
         <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
     </div>
      <div class="form-group">
          <label for="tags">tags</label>
          <select name="tags[]" id="tags" class="custom-select" size="4" multiple="multiple">
              <option selected>choose tags</option>
              @foreach($tags as $tag)
                  <option value="{{$tag->id}}">{{$tag->name}}</option>
              @endforeach
          </select>
      </div>
<button type="submit" class="btn btn-outline-info btn-block">create</button>
        @csrf
    </form>
</div>
@endsection
