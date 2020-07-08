<?php
?>

@extends('layouts.base_layout')
@section('title', 'edit tag: '.$tag->name)
@section('content')
    <div class="container">
        <form action="{{route('tag.update', [$tag->id])}}" method="post">
            @method('PATCH')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" class="form-control" required value="{{old('name', isset($tag)? $tag->name : null)}}">
            </div>
            <div class="form-group">
                <label for="slug">slug</label>
                <input type="text" name="slug" class="form-control" required value="{{old('name', isset($tag)? $tag->slug : null)}}">
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">create</button>
            @csrf
        </form>
    </div>
@endsection

