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
        @if(session()->has('approved'))
        <div class="alert alert-success">
            <i class="fa fa-check" style="font-size:20px"></i> {{ session()->get('approved') }}
        </div>
        @endif

        @if(count($approvals) == 0)
        <div class="alert alert-warning">
            <i class="fa fa-exclamation" style="font-size:20px"></i> No pending posts for approval
        </div>

        @else
        <div class="alert alert-secondary">
            <i class="fa fa-asterisk" style="font-size:20px"></i> New posts are pending approval
        </div>
        @endif
        </div>

    </div>
    <div class="row justify-content-center">

        @foreach ($approvals as $approval)

        <div class="col-md-8">
            <div class="card" style="margin-bottom:3%; border: 1px solid orange">
            <div class="card-header" style="background-color: #ffdd9b">
                <div class="row">
                    <div class="col-md-4 text-left">
                        <p style="font-weight:900; font-size:small; font-style:italic">author: <span style="color:firebrick">{{$approval->user->username}}</span></p>
                    </div>
                    <div class="col-md-4 text-center">
                        <p style="font-weight:900; font-size:small; font-style:italic">category: <span style="color:grey">{{$approval->category->category_name}}</span></p>
                    </div>
                    <div class="col-md-4 text-right">
                        <p style="font-weight:900; font-size:smaller; font-style:italic">created at: <span style="color:green">{{$approval->created_at}}</span></p>
                    </div>
                </div>
                <div class="text-center">
                    <h3 style="color:darkslategray">{{$approval->title}}</h3>
                </div>
            </div>
                <div class="card-body text-center" style="background-color:#ffffdf">
                <img style="border-radius:3%" height="250px" src="{{$approval->image}}">
                <br>
                <br>
                <p>{{$approval->body}}</p>
                <br>
                <div>
                <a href="{{route('approveTopic', $approval->id)}}"><button type="button" class="btn btn-success">Approve <i class="fa fa-check" style="font-size:15px"></i></button></a>
                    <a href="{{route('delete', $approval->id)}}"><button type="button" class="btn btn-danger">Reject <i class="fa fa-trash-o" style="font-size:15px"></i></button></a>
                </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endsection
