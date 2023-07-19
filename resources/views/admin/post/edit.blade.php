@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Add Posts
                <a href="{{ url('admin/posts') }}" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                    @endforeach
                </div>
            @endif
            <form action="{{ url('admin/update-post/'.$post->id) }}" method="POST">
            {{ csrf_field() }}
            @method('PUT')
                <div class="mb-3">
                    <label for="">Post Name</label>
                    <input type="text" name="name" value="{{$post->name}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" value="{{$post->slug}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Descritption</label>
                    <textarea name="description" class="form-control" rows="4">{!! $post->description !!}</textarea>
                </div>
                <h4>Seo Tags</h4>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" value="{{$post->meta_title}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <input type="text" name="meta_description" value="{{$post->meta_description}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Meta Keyword</label>
                    <input type="text" name="meta_keyword" value="{{$post->meta_keyword}}" class="form-control">
                </div>
                <h4>Status</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="">Status</label>
                            <input type="checkbox" value="{{$post->status == '1' ? 'checked':''}}" name="status">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update Post</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection