@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Post
    </button>
    <div class="row justify-content-center">

        <div class="col-md-8">
            @foreach($data as $post)
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    {{ $post->content }}
                </div>
                <p class="comment_show"></p>
                <div class="mb-3 mt-3 offset-sm-8">
                    <input type="text" name="comment" class="form-control" placeholder="Enter Comments here">
                    <input type="hidden" class="post_id" value="{{ $post->id }}">
                    <button type="button" class="btn btn-primary mt-2 AddComments">Comments</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- insert model  -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="AddPost">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $("#AddPost").click(function() {
        var title = $("#title").val();
        var content = $("#content").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("add-posts") }}',
            data: {
                title: title,
                content: content
            },
            type: 'POST',
            success: function(response) {
                console.log(response);
                // Close the modal
                $('#exampleModal').modal('hide');
                // Refresh the page
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    $(".AddComments").click(function() {
        var id = $(this).siblings('.post_id').val();
        var comments = $(this).siblings('.form-control[name="comment"]').val();
        var commentShowElement = $(this).siblings('.comment_show');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("add-comments") }}',
            type: 'POST',
            data: {
                id: id,
                comments: comments
            },
            success: function(response) {
                var allComments = response.result;
                
                console.log(allComments);

                for (var i = 0; i < allComments.length; i++) {
                    commentShowElement.append('<p>' + allComments[i] + '</p>');
                }
                location.reload();
            }
        });
    });
});
</script>
@endsection