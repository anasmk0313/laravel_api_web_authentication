<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('logout') }}" class="float-right btn">Logout</a>
                <h3 class="text-center">Welcom</h3>
                <hr>
                <div class="container">
                    
                    @if(count($data) == 0)
                    <div><span class="text-warning">Warning!</span>  Sale temporarily stoped</div>
                    @else
                    <h3>Flash Sales</h3>
                    <hr>
                    <div class="row">
                        @foreach ($data as $item)
                        <div class="col-md-3 mb-5">
                            <div class="card">
                                 <img src="{{ env('PUBLIC_URL').'/'.$item['product_image'] }}" class="card-img-top" alt="Image">
                                <div class="card-body">
                                     <h5 class="card-title">{{ $item['product_name'] }}</h5>
                                     <h6>Price : {{ $item['price'] }}</h6>
                                     <p class="card-text">{{ $item['description'] }}</p>
                                     <div class="row">
                                         <div class="col-md-6">
                                            <button type="button" class="btn btn-warning" >Add to cart</button>
                                         </div>
                                         <div class="col-md-6">
                                            <button type="button" class="btn btn-primary" >Buy now</button>
                                         </div>
                                     </div>
                                </div>
                            </div>
                         </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>