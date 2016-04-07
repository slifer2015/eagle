<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Course;
use App\Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    private $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    /**
     * Created By Dara on 8/2/2016
     * add reply to comment
     */
    public function article(Article $article, $comment_id, Request $request)
    {

        $user = $this->user;
        $this->validate($request, [
            'content' => 'required'
        ]);
        if ($comment_id) { //check if the comment has been set or not (reply) level 2 comment
            $comment = Comment::findOrFail($comment_id);
            $parent_id = $comment->id;
            $msg = trans('users.answerSent');
            $nested = true;
        } else { //level 1 comment
            $parent_id = 0;
            $msg = trans('users.commentSent');
            $nested = false;
        }
        //add comment to db
        $newComment = $article->comments()->create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
            'parent_id' => $parent_id
        ]);
        $numComment = $article->comments()->count();
        $article->update(['num_comment' => $numComment]);
        $obj=$article;
        $model='article';
        return [
            'hasCallback' => 1,
            'callback' => 'article_comment',
            'hasMsg' => 1,

            'msgType' => '',
            'msg' => $msg,
            'returns' => [
                'newComment' => view('comment.comment', compact('newComment', 'article', 'user','obj','model'))->render(),
                'nested' => $nested,
                'numComment' => $numComment
            ]
        ];


    }

    /**
     * Created By Dara on 8/2/2016
     * add reply to comment
     */
    public function course(Course $course, $comment_id, Request $request)
    {

        $user = $this->user;
        $this->validate($request, [
            'content' => 'required'
        ]);
        if ($comment_id) { //check if the comment has been set or not (reply) level 2 comment
            $comment = Comment::findOrFail($comment_id);
            $parent_id = $comment->id;
            $msg = trans('users.answerSent');
            $nested = true;
        } else { //level 1 comment
            $parent_id = 0;
            $msg = trans('users.commentSent');
            $nested = false;
        }
        //add comment to db
        $newComment = $course->comments()->create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
            'parent_id' => $parent_id
        ]);
        $numComment = $course->comments()->count();
        $course->update(['num_comment' => $numComment]);
        $obj=$course;
        $model='course';
        return [
            'hasCallback' => 1,
            'callback' => 'course_comment',
            'hasMsg' => 1,

            'msgType' => '',
            'msg' => $msg,
            'returns' => [
                'newComment' => view('comment.comment', compact('newComment', 'course', 'user','obj','model'))->render(),
                'nested' => $nested,
                'numComment' => $numComment,
            ]
        ];


    }

    /**
     * Created By Dara on 8/2/2016
     * add reply to comment
     */
    public function session(Session $session, $comment_id, Request $request)
    {

        $user = $this->user;
        $this->validate($request, [
            'content' => 'required'
        ]);
        if ($comment_id) { //check if the comment has been set or not (reply) level 2 comment
            $comment = Comment::findOrFail($comment_id);
            $parent_id = $comment->id;
            $msg = trans('users.answerSent');
            $nested = true;
        } else { //level 1 comment
            $parent_id = 0;
            $msg = trans('users.commentSent');
            $nested = false;
        }
        //add comment to db
        $newComment = $session->comments()->create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
            'parent_id' => $parent_id
        ]);
        $numComment = $session->comments()->count();
        $session->update(['num_comment' => $numComment]);
        $obj=$session;
        $model='session';
        return [
            'hasCallback' => 1,
            'callback' => 'session_comment',
            'hasMsg' => 1,

            'msgType' => '',
            'msg' => $msg,
            'returns' => [
                'newComment' => view('comment.comment', compact('newComment', 'session', 'user','obj','model'))->render(),
                'nested' => $nested,
                'numComment' => $numComment,
            ]
        ];


    }

}
