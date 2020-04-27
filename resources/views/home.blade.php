@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('message'))
        <div class="alert alert-danger">
            <i class="fa fa-check" style="font-size:20px"></i> {{ session()->get('message') }}
        </div>
        @endif
        </div>

        @foreach ($topics as $topic)

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
                <div class="text-center">
                    <p style="font-style:italic; font-weight:900; color: #888888"><i class="fa fa-info-circle" style="font-size:15px"></i> There
                        @if(count($topic->comments) > 1)
                        are
                        @else
                        is
                        @endif
                        {{count($topic->comments)}}
                        @if(count($topic->comments) > 1)
                        comments
                        @else
                        comment
                        @endif
                        on this Topic</p>
                </div>
            </div>
                <div class="card-body text-center" style="background-color:#ffffdf">
                <img style="border-radius:3%" height="250px" src="{{$topic->image}}">
                <br>
                <br>
                <p>{{$topic->body}}</p>
                <br>
                <div>
                    <a href="{{route('comment', $topic->id)}}"><button type="button" class="btn btn-success">Discussion <i class="fa fa-comments-o" style="font-size:15px"></i></button></a>
                    @if((Auth::user()->id == $topic->user_id) || (Auth::user()->role_id == 1))
                <a href="{{route('editTopic', $topic->id)}}"><button type="button" class="btn btn-secondary">Edit <i class="fa fa-edit" style="font-size:15px"></i></button></a>
                    <a href="{{route('delete', $topic->id)}}"><button type="button" class="btn btn-danger">Delete <i class="fa fa-trash-o" style="font-size:15px"></i></button></a>
                    @endif
                </div>
                </div>
            </div>
        </div>

        @endforeach


    </div>
</div>
@endsection
