<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
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
            "title"=>"required|max:80",
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
        
        //creo un count,se slug esiste già ,finchè esiste,applica a quello slug -1, se esiste già,-2 ecc... 
        $count= 1;
        while(Post::where('slug',$slugTmp)->first()){
            $slugTmp=Str::slug($data['title']).'-'.$count;   
            $count++;
        }
        $data['slug']=$slugTmp;
        //creo post vuoto, inserisco i dati, salvo il post, lo spedisco nella index
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
    public function update(Request $request, Post $post)
        {
            $request->validate([
                "title"=>"required|max:80",
                "ingredients"=>"required|string|max:200",
                "img"=>"required|url",
                "price"=>"required|numeric",
                "content"=>"required",
                "time_cooking"=>"required",
            ]);
            //prendo i dati dalla form
            $data=$request->all();
            //se in edit modifico un campo e rimane lo stesso titolo
            if($post->title == $data['title']){
                $slugTmp=$post->slug;
            }else{
                //creare slug con il title
                $slugTmp =Str::slug($data['title']);
                //creo un count,se slug esiste già ,finchè esiste,applica a quello slug -1, se esiste già,-2 ecc... 
                $count= 1;
                while(Post::where('slug',$slugTmp)
                    ->where('id','!=',$post->id)
                    ->first()){
                    $slugTmp=Str::slug($data['title'])."-".$count;   
                    $count++;
                }
            }
       
            $data['slug']=$slugTmp;
    
           
            //inserisco i dati, salvo il post, lo spedisco nella index 
            $post->update($data);                      
            return redirect()->route('admin.posts.show',$post->id);  
         
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
        
        return redirect()->route('admin.posts.index')->with(['mes'=>'cancellato']);
    }
}
