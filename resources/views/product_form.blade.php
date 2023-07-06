<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-6 mt-3 offset-3">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product
                        <a href="{{route('product_list')}}" class="btn btn-danger btn-sm float-right">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('save_product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name:</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Price:</label>
                            <input type="number" name="price" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Quantity:</label>
                            <input type="number" name="quantity" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">image:</label>
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description:</label>
                            <textarea name="description" id="" cols="30" class="form-control" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        new DataTable('#example');
    });
</script>
</body>
</html>
