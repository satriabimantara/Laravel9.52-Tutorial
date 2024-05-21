@extends('layouts.app')
@section('title')
    Blog - List
@endsection
@section('content')
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @php($counter=1)
            @foreach ($posts as $post)
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }} <span class="text-muted">#{{ $counter }}</span></h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href='{{ url("posts/$post->id") }}' class="btn btn-sm btn-outline-secondary">Read more</a>
                            <a href='{{ url("posts/$post->id/edit") }}' class="btn btn btn-sm btn-outline-secondary">Edit</a>
                        </div>
                        <small class="text-muted">Created at: {{ date('Y M d H:i', strtotime($post->created_at)) }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @php($counter++)
            @endforeach
        </div>
    </div>
</div>
@endsection
