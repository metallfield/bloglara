<?php
?>
@extends('layouts.base_layout')
@section('title', 'author')
@section('content')
<div class="container">
    <h2 class="text-center">user list</h2>
    <ul>
        @foreach($users  as $user)
            <li><a href="{{route('user.show', [$user->id])}}">{{$user->name}}</a></li>
            @endforeach
    </ul>
</div>
@endsection
