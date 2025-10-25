@extends('layouts.main')
@section('content')
<div>

        <div> {{$post->id}}. {{$post->title}} </div>
    <div>{{$post->content}}</div>

</div>
    <div>
        <a  href="{{route('posts.index')}}">Back</a>
    </div>
    <div>
        <a href="{{ route('post.edit', $post->id) }}">Edit</a>
    </div>
    <div>
        <form action="{{ route('post.delete', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-primary">
        </form>
    </div>
@endsection
