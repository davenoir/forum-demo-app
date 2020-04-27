@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:5%">
        <div class="col-md-12 text-center">
            <h1>Update Topic</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('topicModify'))
    <div class="alert alert-success">
        <i class="fa fa-check" style="font-size:20px"></i> {{ session()->get('topicModify') }}
    </div>
    @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
        <form method="POST" action="{{route('saveTopic', $topic->id)}}">
                @csrf
                <div class="form-group">
                  <label for="topic">Title</label>
                <input type="text" class="form-control" id="topic" name="topic" placeholder="enter your topic" value="{{$topic->title}}">
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                <input type="text" class="form-control" id="image" name="image" placeholder="enter your image URL" value="{{$topic->image}}">
                </div>
                <div class="form-group">
                    <label for="body">Write your description</label>
                <textarea class="form-control" placeholder="Write your topic description here" rows="4" cols="99" name="body">{{$topic->body}}</textarea>
                    </div>
                <div class="form-group">
                  <label for="category">Select category</label>
                  <select class="form-control" id="category" name="category">
                      @foreach($categories as $category)
                      @if($category->id == $topic->category_id)
                        <option selected="{{$topic->category_id}}" value="{{$category->id}}">{{$category->category_name}}</option>
                        @elseif($category->id != $topic->category_id)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-block">Update Topic <i class="fa fa-plus" style="font-size:15px"></i></button>
                </div>
              </form>
        </div>
    </div>
</div>

@endsection
