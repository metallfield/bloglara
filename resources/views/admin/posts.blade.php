<?php
?>
@extends('layouts.base_layout')
@section('title', 'admin posts')
@section('content')
    <div class="container">
        <table class="table table-light">
            <thead>
            <tr>
                <th>id</th>
                <th>image</th>
                <th>name</th>
                <th>slug</th>
                <th>tags</th>
                <th>author</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td><img src="{{Storage::url($post->image)}}" alt="" width="150" height="100" ></td>
                    <td>
                        {{$post->name}}
                    </td>
                    <td>
                       {{$post->slug}}
                    </td>
                    <td>
                            @foreach($post->tags as $tag)
                            {{$tag->name}},

                        @endforeach
                    </td>
                    <td>
                        <span>{{$post->user['name']}}</span>
                    </td>
                    <td>
                        <form action="{{route('post.destroy', $post)}}" method="POST"><a href="{{route('post.show', [$post])}}" class="btn btn-outline-success">show</a>
                            <a class="btn btn-group btn-warning" href="{{route('post.edit', [$post])}}">edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete">delete</button></form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <a class="btn btn-group btn-success" href="{{route('post.create')}}">create</a>
        <div class="w-100 d-flex justify-content-center">

        </div>

        <div class="row my-4 justify-content-center">
            {{$posts->links()}}
        </div>
    </div>

@endsection
