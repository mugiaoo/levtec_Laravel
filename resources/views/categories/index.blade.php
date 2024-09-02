<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <h1>Blog Name</h1>
        @if(Auth::check())
            <p>Logged in as: {{ Auth::user()->name }}</p>
        @endif
        <a href= '/posts/create'>create</a>
        <div class = 'posts'>
            @foreach($posts as $post)
                <div class = 'post'>
                    <a href="/posts/{{ $post->id }}"><h2 class = 'title'>{{ $post->title }}</h2></a>
                    <p class = 'body'>{{ $post->body }}</p>
                    <!-- カテゴリー名を表示 -->
                    <a href="">{{ $post->category->name }}</a>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost( {{$post->id}} )">delete</button> 
                    </form>
                </div>
            @endforeach
        </div>
        <div class='paginate'>{{ $posts->links()}}</div>
        <!--ボタンが押されると，jacvascriptが動いて，popupが表示される-->
        <script>
            function deletePost(id){
                'use strict'
                
                if(confirm('削除するとグク減できません．\n本当に削除しますか？')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
