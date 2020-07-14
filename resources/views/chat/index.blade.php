<?php
    ?>
@extends('layouts.base_layout')
@section('title', 'chat')
@section('content')

  <div class="table-responsive">
    <h4 align="center">Online User</h4>
    <p align="right">Hi - {{$user->name}}-</p>
    <div id="user_details"></div>
    </div>
        <div class="container" id="user_status"></div>
  <div id="user_model_details"></div>
@endsection
