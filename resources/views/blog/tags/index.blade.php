<?php
?>
@extends('layouts.base_layout')
@section('title', 'tags')
@section('content')

    <div class="container">
        <h2>list of tags</h2>
        <ul>
            @foreach($tags as $k => $v)
                <li><a href="{{route('tag.show', [$v->id])}}">{{$v->name}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
