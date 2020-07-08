<?php
?>

@extends('layouts.base_layout')
@section('title', 'create tag')
@section('content')
    <div class="container">
        <form action="{{route('tag.store')}}" method="post">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="slug">slug</label>
                <input type="text" name="slug" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-outline-info btn-block">create</button>
            @csrf
        </form>
    </div>
@endsection
