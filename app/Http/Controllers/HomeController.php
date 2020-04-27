<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Comment;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $topics = Topic::where('approved', true)->get()->sortByDesc('id');
        return view('home', compact('topics'));
    }

    public function manage()
    {
        $approvals = Topic::where('approved', false)->get();
        return view('approve', compact('approvals'));
    }

    public function delete($id)
    {
        $comments = Comment::where(['topic_id'=>$id]);
        $topic = Topic::findOrfail($id);
        $topic->delete();
        $comments->delete();
        return redirect()->back()->with('message', 'Topic successfully deleted');


    }

    public function approveTopic($id)
    {
        $topic = Topic::findOrfail($id);
        $topic->approved = true;
        $topic->save();

        return redirect()->back()->with('approved', 'Topic successfully approved');
    }

    public function editTopic($id)
    {
        $topic = Topic::findOrFail($id);
        $categories = Category::all();

        return view('edit', compact('topic', 'categories'));
    }

    public function comment($id)
    {
        $comments = Comment::where(['topic_id'=> $id,'reported'=> false])->get()->sortByDesc('id');
        $topic = Topic::findOrFail($id);
        return view('comment', compact('topic','comments'));
    }

    public function reportedComment()
    {
        $comments = Comment::where('reported', true)->get();
        return view('reported', compact('comments'));
    }

    public function approveComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->reported = false;
        $comment->save();
        return redirect()->back()->with('messageApp', 'Comment successfully approved!');
    }

    public function rejectComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('messageRej', 'Comment successfully deleted!');
    }

    public function reportComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->reported = true;
        $comment->save();
        return redirect()->back()->with('messageReport', 'Comment successfully reported for moderation!');
    }

    public function postComment(Request $request, $id)
    {
        $now = Carbon::now();

        $comment = new Comment;

        $comment->user_id = Auth::user()->id;
        $comment->topic_id = $id;
        $comment->comment_body = $request->comment_body;
        $comment->reported = false;
        $comment->created_at= $now;
        $comment->save();
        return redirect()->back()->with('postComment', 'New comment successfully posted!');

    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('messageDelete', 'Comment successfully deleted!');
    }
    public function showTopicForm()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }
    public function createTopic(Request $request)
    {
        $now = Carbon::now();
        $topic = new Topic;

        $topic->title = $request->topic;
        $topic->image = $request->image;
        $topic->body = $request->body;
        $topic->user_id = Auth::user()->id;
        $topic->category_id = $request->category;
        $topic->approved = false;
        $topic->created_at = $now;
        $topic->save();

        return redirect()->back()->with('topicSuccess', 'Topic successfully created!');
    }

    //topics which have been previously approved do not need reapproval form admin
    public function saveTopic(Request $request, $id)
    {
        $now = Carbon::now();
        $topic = Topic::findOrFail($id);

        $topic->title = $request->topic;
        $topic->image = $request->image;
        $topic->body = $request->body;
        $topic->user_id = Auth::user()->id;
        $topic->category_id = $request->category;
        $topic->approved = true;
        $topic->created_at = $now;
        $topic->save();

        return redirect()->back()->with('topicModify', 'Topic successfully modified!');
    }


}
