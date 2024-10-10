<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ArticleController extends Controller
{
    
    public function index()
    {
        $articles = Article::all();
        return view('articles.index',compact('articles'));
    }

    public function confirm_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        session(['article_data' => $request->only(['name', 'content'])]);
        $articleData = session('article_data');
        return view('articles.post_confirm', compact('articleData'));
    }

    public function store(Request $request)
    {
        try{
            $articleData = session('article_data');
            Article::create($articleData);
            session()->forget('article_data');
            return view('articles.complete', ['message'=>'投稿']);
        }catch(\Exception $e){
            return view('error.error_message', ['message'=>'投稿に失敗しました'.$e->getmessage()]);
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit_confirm',compact('article'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        try{
            $article = Article::find($id);
            $article->update($request->only(['name','content']));
            return view('articles.complete', ['message'=>'編集']);
        }catch(\Exception $e){
            return view('error.error_message', ['message'=>'編集に失敗しました'.$e->getmessage()]);
        }
    }

    public function confirm_destroy($id){
        $article = Article::find($id);
        return view('articles.delete_confirm',compact('article'));
    }

    public function destroy($id)
    {
        try{
            Article::destroy($id);
            return view('articles.complete', ['message'=>'消去']);
        }
        catch(\Exception $e){
            return view('error.error_message', ['message'=>'消去に失敗しました'.$e->getmessage()]);
        }
    }
}
