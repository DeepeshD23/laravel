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
            <a href="{{route('products.create')}}" class= "btn btn-dark">Create</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        @if (Session::has('success'))
        <div class="col-md-10 mt-4">
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        </div>
        <div class="col-md-10">
            <div class="card borde-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">
                        Products
                    </h3>
                </div>

                <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            @if ($products->isNotEmpty())
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->image != "")
                                        <img width="50" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>${{ $product->price }}</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('products.edit',$product->id)}}" class="btn btn-dark"> Edit</a>
                                <a href="#" onclick="deleteProduct({{$product->id}});" class="btn btn-danger">Delete</a>
                                <form method="post" id="delete-product-from-{{$product->id}}" action="{{ route('products.destroy',$product->id)}}">
                                    @csrf
                                    @method('post')
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @endif

                    </table>

                </div>

            </div>
        </div>
    </div>

   </div>
  </body>
</html>

<Script>
    function deleteProduct(id){
        if(confirm("are you sure ?"))
        document.getElementById("delete-product-from-"+id).submit();

    }
</Script>
