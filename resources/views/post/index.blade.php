@extends('layouts.main')
@section('content')
<div>
    <div>
        <a href="{{route('post.create')}}" class="btn btn-primary">Create</a>
    </div>
    @foreach($posts as $post)
        <div>
            <a href="{{ route('post.show', $post->id) }}">{{$post->id}}. {{$post->title}}</a>
        </div>
    @endforeach
</div>
@endsection
