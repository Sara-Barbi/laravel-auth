@extends('layouts.admin')

@section('title','new post list')

@section('content')
<form action="{{ route("admin.posts.store") }}" class="text-center d-flex flex-column align-items-center" method='POST'>   <!--con action="{route("posts.store")}" stabilisco la rotta dove andranno i miei dati il metodo che dobbiamo usare è post e questo lo vediamo nella route list accandto a posts.store -->
    @csrf
    <h1 class="mt-5">Create New Post!</h1>
    <label for="title" class="form-label m-3">Title</label>
    <input type="text" name="title" id="title" class="form-control col-6 text-center " placeholder="Insert Title" value="{{old("title")}}"> <!--old('title') serve per lasciare scritto ciò che abbiamo digitato nell'input anche dopo il caricamento, così se abbiamo sbagliato solo un campo, gli altri non li dobbiamo riempire di nuovo.-->
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="content" class="form-label m-3">content</label>
    <input type="text" name="content" id="content" class="form-control col-6 text-center " placeholder="Insert content" value="{{old("content")}}"> <!--E' MOLTO IMPORTANTE CHE NAME E ID SIANO GUALI A CIO' CHE ABBIAMO NEL SERVER-->
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="img" class="form-label m-3">Image</label>
    <input type="text" name="img" id="img" class="form-control col-6 text-center " placeholder="Image url" value="{{old("img")}}">
    @error('img')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="ingredients" class="form-label m-3">ingredients</label>
    <input type="text" name="ingredients" id="ingredients" class="form-control col-6 text-center " placeholder="Insert ingredients" value="{{old("ingredients")}}"> <!--E' MOLTO IMPORTANTE CHE NAME E ID SIANO GUALI A CIO' CHE ABBIAMO NEL SERVER-->
    @error('ingredients')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="price" class="form-label m-3">Price($)</label>
    <input type="text" name="price" id="price" class="form-control col-6 text-center " placeholder="00.00" value="{{old("price")}}">
    @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="time_cooking" class="form-label m-3">time cooking</label>
    <input type="text" name="time_cooking" id="time_cooking" class="form-control col-6 text-center " placeholder="Insert time cooking" value="{{old("time_cooking")}}">
    @error('time_cooking')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-success m-5">Aggiungi</button>            <!--al bottone dobbiamo mettere type='submit' per svolgere l'invio dati, cghe agirà nella route che abbiamo stabilito nella form(riga6)-->
</form>
@endsection