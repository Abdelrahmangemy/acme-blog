@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-shadow mt-4">
                    <div class="card-body">
                        <h2 class="mb-0">{!! $post->name !!}</h2><br>
                        <p>{!! $post->description !!}</p>
                    </div>
                </div>
            </div>

            <div class="comment-area mt-4">
                @if (session('message'))
                <h6 class="alert alert-success mb-3">{{session('message')}}</h6>
                @endif
                <div class="comment-container card card-body">
                    <h6 class="card-title">Leave a Comment</h6>
                    <form action="{{url('comments')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="post_slug" value="{{ $post->slug }}">
                        <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
                @forelse ($post->comments as $comment)
                <div class="card card-body shadow-sm mt-3">
                    <div class="detail-area">
                        <h6 class="user-name- mb-1">
                            @if ($comment->user)
                                {{$comment->user->name}}
                            @endif
                            <small class="ms-3 text-primary">Commented On: {{$comment->created_at->format('d-m-Y')}}</small>
                        </h6>
                        <p class="user-comment mb-1">
                            {!! $comment->comment_body !!}
                        </p>
                    </div>
                    @if(Auth::check() && Auth::id() == $comment->user_id)
                    <div>
                        <button type="button" value="{{ $comment->id }}" class="deleteComment btn btn-danger btn-sm me-2" >Delete</button>
                    </div>
                    @endif
                </div>
            </div>
            @empty
                <h6>No Comments Yet.</h6>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.deleteComment', function() {

                if (confirm("Are you sure you want to delete this comment")) {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();
                    $.ajax({
                        type: "POST",
                        url: "/delete-comment",
                        data: {
                            'comment_id': comment_id
                        },
                        success: function (res) {
                            if (res.status == 200) {
                                thisClicked.closest('.comment-container').remove();
                                alert(res.message);
                            }else {
                                alert(res.message);
                            }
                        }
                    });
                }
            });
        });
    </script>

@endsection