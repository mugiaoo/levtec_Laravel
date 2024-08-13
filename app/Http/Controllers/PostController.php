<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller{
    
    public function index(Post $post){
        //return view('posts.index')->with(['posts' => $post->getByLimit()]); //posts（配列）でviewにデータを渡す
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(5)]);
    }
    
    public function show(Post $post){
        //dd($post); データの中身を見るattributesのところ
        return view('posts.show')->with(['post' => $post]);
    }
    
    public function create(){
        return view('posts.create');
    }
    
    public function store(PostRequest $request, Post $post){
        //dd($request->all());
        $input = $request['post'];
        $post->fill($input)->save(); //fill() メソッドは、$input 配列のキーとマッチするモデルの属性を設定 fill()->save() はcreate()と一緒
        return redirect('/posts/' . $post->id);
    }
}

?>

