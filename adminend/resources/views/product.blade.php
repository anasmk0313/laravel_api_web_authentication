<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('logout') }}" class="float-right btn">Logout</a>
                <h3 class="text-center">Products</h3>
                <hr>
                <a href="{{ route('create.product') }}" class="btn">Create Product</a>
                <a href="#" class="btn">View Product</a>
                <hr>
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    <hr>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        @if (count($product) == 0)
                            <div class="text-center">No data fount!</div>
                        @else
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">View</th>
                            <th scope="col">Delete</th>
                        </tr>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($product as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->price }}</td>
                                <td><a href="{{ route('product.view', $item->id) }}"><button class="btn btn-secondary">View</button></a></td>
                                <td><button class="btn btn-danger" onclick="productDelete({{ $item->id }})" data-toggle="modal" data-target="#deleteModal">Delete</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{ $product->links("pagination::bootstrap-4") }}
                  </table>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, do you want to delete?
                </div>
                <form action="{{ route('product.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="product_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        productDelete = (id) => {
            document.getElementById('product_id').value = id;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>