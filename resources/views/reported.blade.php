@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('messageApp'))
        <div class="alert alert-success">
            <i class="fa fa-check" style="font-size:20px"></i> {{ session()->get('messageApp') }}
        </div>
        @endif
        @if(session()->has('messageRej'))
        <div class="alert alert-danger">
            <i class="fa fa-check" style="font-size:20px"></i> {{ session()->get('messageRej') }}
        </div>
        @endif
        @if(count($comments) == 0)
        <div class="alert alert-warning">
            <i class="fa fa-exclamation" style="font-size:20px"></i> No pending comments for moderation
        </div>

        @else
        <div class="alert alert-secondary">
            <i class="fa fa-asterisk" style="font-size:20px"></i> New comments are pending moderation
        </div>
        @endif
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
            <a href="{{route('approve', $comment->id)}}"><button type="button" class="btn btn-success">Approve <i class="fa fa-check" style="font-size:15px"></i></button></a>
            <a href="{{route('reject', $comment->id)}}"><button type="button" class="btn btn-danger">Delete <i class="fa fa-trash-o" style="font-size:15px"></i></button></a>
            </div>
            </div>
        </div>
    </div>

    @endforeach
    </div>
</div>
@endsection
