<!DOCTYPE html>
<html>

<head>
    <title>Company</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <head>
        <!-- Other meta tags and script tags -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background-color: #333;
            color: #fff;
            width: 200px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 20px;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .content {
            margin-left: 200px;
            /* adjust this value to match the sidebar's width */
            padding: 20px;
        }
        .logo-image {
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <ul>
            <li class="offset-sm-2">
                <h3>Admin</h3>
            </li>
            <li class="offset-sm-2">
                <img src="{{asset('images/admin.jpg')}}" alt="Company Logo" class="logo-image" width="100" height="100">
            </li>
            <li class="mt-5 pl-5">
               <a href="{{route('get_comment')}}">Comment</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <?php
                        if (Session::has('status')) {
                            if (Session::get('status')) {
                                ?>
                                <h3 style="color:green"><?php echo Session::get('msg') ?></h3>
                                <?php
                            } else {
                                ?>
                                <h3 style="color:red"><?php echo Session::get('msg') ?></h3>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <a href="" style="display: inline-block; margin-left: 1000px;">Logout</a>
                </div>
                <div class="">
                    <h1>Post</h1>
                    <table id="user-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Post title</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="user-table-body">
                            @php
                            if($data->isNotEmpty()){
                            foreach($data as $u){
                            
                                @endphp
                            <tr>
                                <td>{{ $u->title }}</td>
                                <td>{{ $u->content }}</td>
                                <td>
                                    <?php $edit_butn = "btn btn-primary"; ?>
                                    <button class="{{ $edit_butn }} edit-btn" data-post-id="{{ $u->id }}" data-user-id="{{ $u->id }}" data-user-title="{{ $u->title }}" data-user-content="{{ $u->content }}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="text-white">edit</i></button>

                                    <button class="btn btn-danger delete-btn" data-post-id="{{ $u->id }}">Delete</button>
                                </td>
                            </tr>
                            @php
                            }
                            }
                            @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- update model -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
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
                    <button type="button" class="btn btn-primary" id="UpdatePost">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#user-table').DataTable();

            $('.delete-btn').click(function() {
                var post_id = $(this).data('post-id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
             

                $.ajax({
                    url: "{{route('delete-post')}}",
                    type: 'POST',
                    data: {
                        post_id: post_id,
                        _token: csrfToken
                    },
                    success: function(response) {
                        alert(response.result);
                        window.location.reload();
                    }
                });
            });

            $('.edit-btn').click(function() {
    var postId = $(this).data('post-id'); // Retrieve post_id from data attribute
    var userId = $(this).data('user-id');
    var title = $(this).data('user-title');
    var content = $(this).data('user-content');

    console.log("post_id:", postId); // Output post_id to the console

    $('#post-id').val(postId);
    $('#title').val(title);
    $('#content').val(content);

    $('#UpdatePost').attr('data-post-id', postId);
});


$('#UpdatePost').click(function() {
    var postId = $(this).data('post-id');
  
    var title = $('#title').val();
    var content = $('#content').val();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{route('update-post')}}", // Specify the update endpoint URL
        type: 'POST',
        data: {
            id: postId,
            title: title,
            content: content,
            _token: csrfToken
        },
        success: function(response) {
            alert(response.result);
            window.location.reload();
        }
    });
});

        });
    </script>
</body>

</html>
