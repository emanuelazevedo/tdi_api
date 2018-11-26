<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentUpdateRequest;
use App\Http\Requests\CommentCreateRequest;
use Illuminate\Http\Request;
use Validator;
use App\Comment;

class CommentController extends Controller
{
    //
    /**
     * Listar Comentarios
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comment = Comment::all();
        return $comment;
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
     * Criar um Comentarios
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentCreateRequest $request)
    {
        //

        $data = $request->only(['commentText', 'article_id', 'user_id']);


        $comment = Comment::create($data);
        return Response([
          'status' => 0,
          'data' => $comment,
          'msg' => 'ok'
        ], 200);

    }

    /**
     * Mostrar um Comentario
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
        $user = $comment->user;
        $article = $comment->article;
        return $comment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Editar um Comentario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        //
        $data = $request->only(['commentText', 'article_id', 'user_id']);

        $comment->comment = $data['commentText'];
        $comment->article_id = $data['article_id'];
        $comment->user_id = $data['user_id'];
        $comment->save();

        return Response([
          'status' => 0,
          'data' => $comment,
          'msg' => 'ok'
        ], 200);

    }

    /**
     * Remover um Comentario
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        Comment::destroy($comment['id']);
        return Response([
          'status' => 0,
          'data' => $comment,
          'msg' => 'ok'
        ], 200);
    }
}
