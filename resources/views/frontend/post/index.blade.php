@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @forelse ($post as $postItem)
                <div class="card card-shadow mt-4">
                    <div class="card-body">
                        <a href="{{ url('/'.$postItem->slug) }}" class="text-decoration-none">
                            <h2 class="post-heading">{{ $postItem->name }}</h2>
                        </a>
                        <h6>Posted On: {{ $postItem->created_at->format('d-m-y') }} </h6>
                        <span class="ms-3">Posted By: {{ $postItem->user->name }} </span>
                    </div>
                </div>
                @empty
                <div class="card card-shadow mt-4">
                    <div class="card-body">
                        <h2 class="post-heading">No Post Available</h2>
                    </div>
                </div>
                @endforelse

                <div class="your-paginate mt-4">
                    {{ $post->links() }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="border p-2">
                    <h4>Advertising Here</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>

.card-shadow{
    box-shadow: 0 2px 8px 0 rgb(0 0 0 / 10%);
    border-radius: 5px;
}

.post-heading{
    font-size: 26px;
    color: #000;
}

</style>