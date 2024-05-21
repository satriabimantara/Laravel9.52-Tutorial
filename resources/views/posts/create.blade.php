@extends('layouts.app')

@section('title')
    Blog - Create
@endsection
@section('content')
<h3>Create new blog</h3>
@include('posts.components.formcrud')

@endsection
