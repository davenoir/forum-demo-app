@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('messageReport'))
        <div class="alert alert-warning">
            <i class="fa fa-exclamation" style="font-size:20px"></i> {{ session()->get('messageReport') }}
        </div>
        @endif
        @if(session()->has('postComment'))
        <div class="alert alert-success">
            <i class="fa fa-check" style="font-size:20px"></i> {{ session()->get('postComment') }}
        </div>
        @endif
        @if(session()->has('messageDelete'))
        <div class="alert alert-danger">
            <i class="fa fa-check" style="font-size:20px"></i> {{ session()->get('messageDelete') }}
        </div>
        @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom:3%; border: 1px solid orange">
            <div class="card-header" style="background-color: #ffdd9b">
                <div class="row">
                    <div class="col-md-4 text-left">
                        <p style="font-weight:900; font-size:small; font-style:italic">author: <span style="color:firebrick">{{$topic->user->username}}</span></p>
                    </div>
                    <div class="col-md-4 text-center">
                        <p style="font-weight:900; font-size:small; font-style:italic">category: <span style="color:grey">{{$topic->category->category_name}}</span></p>
                    </div>
                    <div class="col-md-4 text-right">
                        <p style="font-weight:900; font-size:smaller; font-style:italic">created at: <span style="color:green">{{$topic->created_at}}</span></p>
                    </div>
                </div>
                <div class="text-center">
                    <h3 style="color:darkslategray">{{$topic->title}}</h3>
                </div>
            </div>
                <div class="card-body text-center" style="background-color:#ffffdf">
                <img style="border-radius:3%" height="250px" src="{{$topic->image}}">
                <br>
                <br>
                <p>{{$topic->body}}</p>
                <br>
                <div style="float:right">
                <a href="{{route('home')}}"><button type="button" class="btn btn-warning">Back to Topics <i class="fa fa-undo" style="font-size:15px"></i></button></a>
                </div>
                </div>
            </div>
        </div>
    </div>
    <br>
        <div class="row justify-content-center">
            <div class="col-md-8">
            <form method="POST" action="{{route('postComment', $topic->id)}}">
                @csrf
                    <div class="form-group">
                    <label for="editor" style="font-style:italic; font-weight:900; font-size:large">Write your comment</label>
                    <textarea class="form-control" placeholder="Write your comment here" rows="4" cols="99" name="comment_body"></textarea>
                    </div>
                    <div style="float:right">
                    <button type="submit" class="btn btn-success">Post comment <i class="fa fa-comments-o" style="font-size:15px"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
            <h2 style="font-style:italic; font-weight:900">Comments</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p style="font-style:italic; font-weight:900; color: #888888"><i class="fa fa-info-circle" style="font-size:15px"></i> There
                    @if(count($comments) > 1)
                    are
                    @else
                    is
                    @endif
                    {{count($comments)}}
                    @if(count($comments) > 1)
                    comments
                    @else
                    comment
                    @endif
                    on this Topic</p>
            </div>
        </div>
        <div class="row justify-content-center">
        @foreach ($comments as $comment)

        <div class="col-md-8">
            <div class="card" style="margin-bottom:3%; border: 1px solid black">
            <div class="card-header" style="background-color: #C0C0C0">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <p style="font-weight:900; font-size:small; font-style:italic">user: <span style="color:firebrick">{{$comment->user->username}}</span></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p style="font-weight:900; font-size:smaller; font-style:italic">at: <span style="color:green">{{$comment->created_at}}</span></p>
                    </div>
                </div>
            </div>
                <div class="card-body text-center" style="background-color: #E8E8E8">
                <br>
                <p>{{$comment->comment_body}}</p>
                <br>
                <div style="float:right">
                <a href="{{route('reportComment', $comment->id)}}"><button type="button" class="btn btn-primary">Report <i class="fa fa-bullhorn" style="font-size:15px"></i></button></a>
                    @if((Auth::user()->id == $comment->user_id) || (Auth::user()->role_id == 1))
                <a href="{{route('deleteComment', $comment->id)}}"><button type="button" class="btn btn-danger">Delete <i class="fa fa-trash-o" style="font-size:15px"></i></button></a>
                    @endif
                </div>
                </div>
            </div>
        </div>

        @endforeach
        </div>

    </div>
</div>

@endsection
