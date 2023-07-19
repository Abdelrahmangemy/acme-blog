@extends('layouts.master')

@section('title', 'Add Post')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
                @endforeach
            </div>
        @endif

        <div class="card-header">
            <h4>Add Posts</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/add-post') }}" method="POST">
            {{ csrf_field() }}
                <div class="mb-3">
                    <label for="">Post Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Descritption</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>
                <h4>Seo Tags</h4>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <input type="text" name="meta_description" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control">
                </div>
                <h4>Status</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="">Status</label>
                            <input type="checkbox" name="status">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end">Save Post</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection