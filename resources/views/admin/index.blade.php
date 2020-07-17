<?php
?>
@extends('layouts.base_layout')
@section('title', 'admin')
@section('content')

    <div class="container">
        <h2>admin page</h2>
        <ul>
            <li>
                <a href="{{route('admin_posts')}}">posts redaction</a>
            </li>
            <li>
                <a href="{{route('admin_tags')}}">tags redaction</a>
            </li>
        </ul>
    </div>
@endsection
