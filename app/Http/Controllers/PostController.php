<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller{
    
    public function index(Post $post){
        //config('services.teratail.token');
        //return view('posts.index')->with(['posts' => $post->getByLimit()]); //posts（配列）でviewにデータを渡す
        //return view('posts.index')->with(['posts' => $post->getPaginateByLimit(5)]);
         // クライアントインスタンス生成
        $client = new \GuzzleHttp\Client();

        // GET通信するURL
        $url = 'https://teratail.com/api/v1/questions';

        // リクエスト送信と返却データの取得
        // Bearerトークンにアクセストークンを指定して認証を行う
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        
        // API通信で取得したデータはjson形式なので
        // PHPファイルに対応した連想配列にデコードする
        $questions = json_decode($response->getBody(), true);
        
        // index bladeに取得したデータを渡す
        return view('posts.index')->with([
            'posts' => $post->getPaginateByLimit(),
            'questions' => $questions['questions'],
        ]);
    }
    
    public function show(Post $post){
        //dd($post); データの中身を見るattributesのところ
        return view('posts.show')->with(['post' => $post]);
    }
    
    public function store(PostRequest $request, Post $post){
        //dd($request->all());
        $input = $request['post'];
        $post->fill($input)->save(); //fill() メソッドは、$input 配列のキーとマッチするモデルの属性を設定 fill()->save() はcreate()と一緒
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post){
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post){
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post){
        $post->delete();
        return redirect('/');
    }
    
    public function create(Category $category){
        return view('posts.create')->with(['categories' => $category->get()]);
    }
}

?>

