@extends('layouts.admin')

@section('title','product list')

@section('content')
<div class="container text-center d-flex flex-column align-items-center">
    <h1>{{$post->title}}</h1>
    <div class="col-5">
        <img src="{{$post->img}}" alt="" class="w-100">
    </div>
    <p><strong>Ingredients:</strong> {{$post->ingredients}}</p>
    <ul class='p-0'>
        <strong>Description:</strong> 
        <li>
            {{$post->content}}
        </li>
    </ul>
    <ul class='p-0'>
        <strong>Price:</strong> 
        <li>
            {{$post->price}}
        </li>
    </ul>
    <ul class='p-0'>
        <strong>Time for Cook:</strong> 
        <li>
            {{$post->time_cooking}}
        </li>
    </ul> 
    <a href="{{route("admin.posts.index")}}"><button type="button" class="btn btn-primary">Back</button></a>
</div>
@endsection