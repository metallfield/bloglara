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
    <script id="userTempl" type="text/x-jquery-tmpl">
        <li>${username}: ${status}</li><button type="button" class=" start_chat"  data-touserid="${user_id}" data-tousername="${username}">Start Chat</button>
    </script>
    <div id="user_model_details"></div>


    <script id="messageTmpl" type="text/x-jquery-tmpl"> <ul class="list-unstyled">
   <b class="text-success">${username}</b>
        <li style="border-bottom:1px dotted #ccc"><p> - ${message}
                <div align="right">
                 - <small><em> ${updated_at} </em></small>
               </div>
            </p>
            </li></ul>
</script>
@endsection
