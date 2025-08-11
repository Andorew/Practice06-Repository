<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest; // useする

class PostController extends Controller
{
    public function index(Post $post) //このPostはPost.php(modeldirectory)内にあるクラス名で＄postは変数名。Laravelではモデルのクラスを指定するとインスタンス(空の状態)を作り、$postに渡してくれる。
    {                                       //これを書くことでPostモデルのメゾットを呼び出せるようになる。＊$post は 1件のデータ ではなく、Postモデルのインスタンス（器） 。
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]); //postsという名前（変数）でgetPaginateByLimit()の実行結果をindex.bladeに渡す。今回はDBから記事一覧を取得。
    }

    public function show(Post $post)
    {

        return view('posts.show')->with(['post' => $post]); //withでviewにデータベースからでーたを渡しているだけ。よく使われるのはview('posts.show', ['post' => $post]);同じ意味。compacr関数てのもある。
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Post $post, PostRequest $request) // 引数をRequestからPostRequestにする
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();

        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
