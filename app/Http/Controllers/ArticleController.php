<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5); 
        return view('articles.view', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        // Check role 
        if(auth()->user()->hasRole('author') || auth()->user()->hasRole('editor')){
            $cats = \App\Category::all();
            return view('articles.create', compact('cats'));    
        }else{
            return redirect()->route('get-articles')->with('error', 'You aren\'t author or editor to take this action');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check role 
        if(auth()->user()->hasRole('author') || auth()->user()->hasRole('editor')){
            $this->validate($request, [
                'title' => 'required|min:5',
                'content' => 'required|min:10',
                'category' => 'required|exists:categories,id',
            ]);
            
            $article = new Article;
            $article->title = $request->title;
            $article->content = $request->content;
            $article->category_id = $request->category;
            $article->user_id = auth()->id();
            $article->save();
            
            return redirect()->route('get-articles')->with('success', 'Article saved');
        }else{
            return redirect()->route('get-articles')->with('error', 'You aren\'t author or editor to take this action');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('articles.show', ['article' => Article::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Check role 
        if(auth()->user()->hasRole('author') || auth()->user()->hasRole('editor')){
            $cats = \App\Category::all();
            return view('articles.edit', ['cats' => $cats, 'article' => Article::findOrFail($id)]); 
        }else{
            return redirect()->route('get-articles')->with('error', 'You aren\'t author or editor to take this action');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Check role 
        if(!auth()->user()->hasRole('author') || !auth()->user()->hasRole('editor')){
            $this->validate($request, [
                'title' => 'required|min:5',
                'content' => 'required|min:10',
                'category' => 'required|exists:categories,id',
            ]);
            
            $article = Article::findOrFail($id);
            $article->title = $request->title;
            $article->content = $request->content;
            $article->category_id = $request->category;
            $article->save();
            
            return redirect()->route('get-articles')->with('success', 'Article updated');
        }else{
            return redirect()->route('get-articles')->with('error', 'You aren\'t author or editor to take this action');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check role 
        if(auth()->user()->hasRole('author')){
            Article::find($id)->delete();
            return redirect()->route('get-articles')->with('success', 'Article deleted');   
        }else{
            return redirect()->route('get-articles')->with('error', 'You aren\'t author or editor to take this action');
        }
    }

}
