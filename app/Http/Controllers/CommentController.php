<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comments($id)
    {
        $comments_blog = Comment::with('replies.user')
            ->where('comments.blog_id', '=', $id)
            ->leftJoin('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.name')
            ->get();

        if ($comments_blog->count() > 0) {
            return view('user.comments', compact('comments_blog', 'id'));
        } else {
            return view('user.comments', compact('id'));
        }
    }

    public function comment_tree()
    {
    }
    public function store(Request $request)
    {
        $blog_id = $request->blog_id;
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->body = $request->body;
        $comment->save();
        return redirect()->route('user.comments', ['id' => $blog_id]);
    }

    public function replystore(Request $request)
    {
        $blog_id = $request->blog_id;
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->body = $request->body;
        $comment->parent_id = $request->comment_id;
        $comment->save();

        return redirect()->route('user.comments', ['id' => $blog_id]);
    }

    public function adcomments($id)
    {

        $comments_blog = Comment::with('replies.user')
            ->where('comments.blog_id', '=', $id)
            ->leftJoin('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.name')
            ->get();


        if ($comments_blog->count() > 0) {
            return view('admin.comments', compact('comments_blog', 'id'));
        } else {
            return view('admin.comments', compact('id'));
        }
    }
}
