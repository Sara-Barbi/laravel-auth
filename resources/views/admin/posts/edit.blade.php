@extends('layouts.admin')

@section('title','post change')

@section('content')
<form action="{{ route("admin.posts.update",$post->id) }}" class="text-center d-flex flex-column align-items-center" method='POST'>   <!--post->id serve per recuperate proprio quell'elem con quell'id. dove lo trovo? semplice , nel Controller nella sezione edit vedrò che ho passato la variabile post che contiene il singolo elemento dove abbiamo cliccato edit-->
    @csrf
    @method('PUT')                                                     <!--grazie al metodo PUT riesco a prendere il mio elemento, come faccio a sapere se prendere PUT o GET?? lo vedo nella Route List-->
    <h1>STAI MODIFICANDO : <strong>{{$post->title}}</strong></h1>           
                                                          <!--  in questo caso ho visionato la route list e ho visto che per la mia rotta desiderata('update') ho bisogno del PUT-->
    <label class="form-label m-3" for="title">Title</label>
    <input type="text" name="title" id="title"class="form-control col-6 text-center " placeholder="Insert Title"
    value="{{old("title")??$post->title}}">                            <!--questa è una condizione if. O fa l'old(cioe va a scrivere cosa c'è stato precedentemente inserito a mano) o ci mette il 'title' di quell'elemento lì. Stiamo parlando di editaggio, perciò è comodo avere i parametri di ciò che vogliamo modificare già scritti, soprattutto se ne vogliamo cambiare solo 1.In questo caso se viene cancellato tutto ciò che c'è scritto nell'imput apparirà il placeholder.-->
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label class="form-label m-3" for="content">content</label>
    <input type="text" name="content" id="content" class="form-control col-6 text-center " placeholder="Insert content"
    value="{{old("content")??$post->content}}">
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label class="form-label m-3" for="img">Image</label>
    <input type="text" name="img" id="img" class="form-control col-6 text-center " placeholder="Insert Image url"
    value="{{old("img")??$post->img}}">
    @error('img')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label class="form-label m-3" for="ingredients">ingredients</label>
    <input type="text" name="ingredients" id="ingredients" class="form-control col-6 text-center " placeholder="Insert ingredients"
    value="{{old("ingredients")??$post->ingredients}}">
    @error('ingredients')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label class="form-label m-3" for="price">Price($)</label>
    <input type="text" name="price" id="price" class="form-control col-6 text-center " placeholder="Insert Price"
    value="{{old("price")??$post->price}}">
    @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <label class="form-label m-3" for="time_cooking">Time cooking</label>
    <input type="text" name="time_cooking" id="time_cooking" class="form-control col-6 text-center " placeholder="3 min"
    value="{{old("time_cooking")??$post->time_cooking}}">
    @error('time_cooking')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-success m-5">Aggiungi</button>
</form>
@endsection