@extends('layouts.app')
@section('title')
    Blog - {{$post->title}}
@endsection
@section('custom-css')
<link href="{{ asset('css/blog.css') }}" rel="stylesheet">
@endsection
@section('content')
<article class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ date('Y M d', strtotime($post->updated_at)) }} by <strong class="text-muted">Mr.x</strong></p>
    <p>{{ $post->content }}</p>
    <a href="{{ url('/posts') }}" class="card-link">Back to blogs</a>
    <hr>

    <div class="row">
        <div class="col">
            <form action="{{ url('comments/') }}" method="post">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <label for="comment" class="form-label">Drop your comment!</label>
                    <textarea
                    class="form-control"
                    id="comment"
                    name="comment"
                    rows="5"
                    ></textarea>
                </div>
                <button type="submit" class="btn btn-info btn-sm">Post</button>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <h6 class="card-subtitle mb-2 text-muted">{{ count($comments) }} Komentar</h6>
            <ul class="list-group">
                @foreach ($comments as $comment)
                <li class="list-group-item card-text">{{ $comment->comment }}</li>

                @endforeach
            </ul>

        </div>
    </div>


  </article>
@endsection
