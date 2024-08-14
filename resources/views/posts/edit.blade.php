
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts/{{ $post->id }}" method="POST">
            <!-- 他のURLからのリクエストを拒否．セキュリ的な問題-->
            @csrf
            @method('PUT')
            <div class="title">
                <h2>Title</h2>
                <input type='text' name='post[title]'  value="{{ $post->title }}"> 
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                 <input type='text' name='post[body]' value="{{ $post->body }}">
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <!--登録ボタン-->
            <input type="submit" value="update">
        </form>
        <div class="footer">
            <a href="/posts/{{ $post->id }}">戻る</a>
        </div>
    </body>
</html>