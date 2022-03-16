<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required|string|max:80|unique:posts",
            "ingredients"=>"required|string|max:200",
            "img"=>"required|url",
            "price"=>"required|numeric",
            "content"=>"required",
            "time_cooking"=>"required",
        ]);
        //prendo i dati dalla form
        $data=$request->all();

        //creare slug con il title
        $slugTmp =Str::slug($data['title']);
        $data['slug']=$slugTmp;

        //creo un count,se slug esiste già ,finchè esiste,applica a quello slug -1, se esiste già,-2 ecc... 
        $count= 1;
        while(Post::where('slug',$slugTmp)->first()){
            $slugTmp=Str::slug($data['title']).'-'.$count;   
            $count++;
        }

        $newPost= new Post();   
        $newPost->fill($data);     
        $newPost->save();                   
        return redirect()->route('admin.posts.index');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
         //$product = Product::find($id);
         return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $posts)
    {
        $request->validate([
            "title"=>"required|string|max:80|unique:posts,title,{$post->id}",
            "ingredients"=>"required|string|max:200",
            "img"=>"required|url",
            "price"=>"required|numeric",
            "content"=>"required",
            "time_cooking"=>"required",
        ]);
        //in questa fase abbiamo un codice che è uguale a quello nello store, ma al posto di generare un nuovo elemento(richiamando il Model)chiamo la variabile che lo rappresenta, che mi andrà a prendere proprio quell'oggetto li.
        $data=$request->all();
  
        $post->update($data);                          //metodo meno sicuro ma più compatto a livello di codice

        return redirect()->route('posts.show',$post->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('posts.index')->with(['mes'=>'cancellato']);
    }
}
