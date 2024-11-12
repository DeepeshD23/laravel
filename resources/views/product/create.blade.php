<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
   <div class='bg-dark py-3'>
        <h1 class="text-white text-center">Laravel 11 CRUD</h1>
   </div>
   <div class="container">
   <div class ="row justity-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{route('products.index')}}" class= "btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card borde-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">
                        Create Product
                    </h3>
                </div>
                <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="post">
                    @csrf
                     <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label h4">Name</label>
                            <input value="{{old('Name')}}" type="text" class="@error('Name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="Name">
                            @error('Name')
                                <p class="invalid-feeback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h4">Sku</label>
                            <input value="{{old('Sku')}}" type="text" class="@error('Sku') is-invalid @enderror form-control form-control-lg" placeholder="Sku" name="Sku">
                            @error('Sku')
                                <p class="invalid-feeback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h4">Price</label>
                            <input value="{{old('Price')}}" type="text" class="@error('Price') is-invalid @enderror form-control form-control-lg" placeholder="Price" name="Price">
                            @error('Price')
                                <p class="invalid-feeback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h4">Description</label>
                            <textarea placeholder="Description" class="form-control" name="Description" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Image</label>
                            <input type="file" class="form-control form-control-lg" placeholder="image" name="image">
                        </div>
                        <div class="d-grid">
                            <button class ="btn btn-lg btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

   </div>
  </body>
</html>
