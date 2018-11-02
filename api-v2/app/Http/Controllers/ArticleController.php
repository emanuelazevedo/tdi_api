<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Requests\ArticleCreateRequest;
use Illuminate\Http\Request;
use App\Article;
use Validator;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Image;

class ArticleController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $article = Article::all();
        return $article;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCreateRequest $request)
    {
        //

        $data = $request->only(['title', 'description', 'image', 'user_id']);

        $data['image'] = $request->file('image');
        // Storage::putFile('image', new File(public_path.'articleImages'));
        $filename = time().'.'.$data['image']->getClientOriginalExtension();
        Image::make($data['image'])->save(public_path('/articleImages'.$filename));
        $article = Article::create($data);
        return Response([
          'status' => 0,
          'data' => $article,
          'msg' => 'ok'
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
        $user = $article->user;
        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        //
        $data = $request->only(['title', 'description', 'image', 'user_id']);

        $article->title = $data['title'];
        $article->description = $data['description'];
        $article->image = $data['image'];
        $article->user_id = $data['user_id'];
        $article->save();

        return Response([
          'status' => 0,
          'data' => $article,
          'msg' => 'ok'
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
        Article::destroy($article['id']);
        return Response([
          'status' => 0,
          'data' => $article,
          'msg' => 'ok'
        ], 200);
    }
}
