<?php
?>
@extends('layouts.base_layout')
@section('title', 'admin tags')
@section('content')
    <div class="container">
        <h2>tags page</h2>
        <table class="table table-light">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>slug</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <th scope="row">{{$tag->id}}</th>
                    <td>
                        {{$tag->name}}
                    </td>
                    <td>
                        {{$tag->slug}}
                    </td>
                    <td>
                        <form action="{{route('tag.destroy', $tag)}}" method="POST"><a href="{{route('tag.show', [$tag])}}" class="btn btn-outline-success">show</a>
                            <a class="btn btn-group btn-warning" href="{{route('tag.edit', [$tag])}}">edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete">delete</button></form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <a class="btn btn-group btn-success" href="{{route('tag.create')}}">create</a>
        <div class="w-100 d-flex justify-content-center">

        </div>
    </div>

@endsection
