@extends('layouts.admin')

@section('title','posts list')

@section('content')
<div class="text-center">
    <a href="{{route("admin.posts.create")}}"><button type="button" class="btn btn-success mb-5 mt-5">Aggiungi</button></a>  <!--questo bottone se cliccato reindirizza alla route posts/create, possiamo vedere la rotta con php artisan route:list-->
</div>
@foreach($posts as $post)
<div class="container d-flex flex-column align-items-center">
    <h1>{{$post->title}}</h1>
    <p><strong>Time Cooking:</strong> {{$post->time_cooking}}</p>
    <div class="col-5">
        <img class="w-100" src="{{$post->img}}" alt="">
    </div>
    <p><strong>ingredients:</strong> {{$post->ingredients}}</p>
    <ul class="p-0">
        <strong>Description:</strong> 
        <li>
            {{$post->content}}
        </li>
    </ul>
    <div class="d-flex">
        <a href="{{route("admin.posts.show", $post->id)}}"><button type="button" class="btn btn-primary m-3">See More</button></a>  <!--con questo bottone richiamo la rotta posts/show dove show sarà il numero id del mio elemento.Quindi verrò indirizzato alla vista show.blade.php-->
        <a href="{{route("admin.posts.edit", $post->id)}}"><button type="button" class="btn btn-primary m-3">Edit</button></a>  <!--con questo bottone richiamo la rotta posts/edit dove potrò modificare il mio elemento.Quindi verrò indirizzato alla vista edit.blade.php-->
        <form action="{{route("admin.posts.destroy", $post->id)}}" method="POST" onsubmit="return confirm('sicuro?')">
            @csrf
            
            @method("DELETE")
            <button type="submit" class="btn btn-danger m-3">Delete</button>
        </form>
    </div>
</div>
<hr>
    @endforeach
@endsection
