@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="d-flex justify-content-between">
                    <h4 class="m-3">Add Product</h4>
                    <button  data-bs-toggle="modal" data-bs-target="#addproduct"class="btn btn-warning m-3">Add Product</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Alert Stock</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    @foreach($product as $key=>$products)
                        <tbody>
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$products['product_name']}}</td>
                                <td>{{$products['brand']}}</td>
                                <td>$ {{$products['price']}}</td>
                                <td>{{$products['quantity']}}</td>
                                <td>
                                    @if( $products['quantity'] < $products['alert_stock'])
                                        <span style="background:red;padding:5px;color:white;border-radius:8px;">product stock low</span>
                                    @else
                                        <span style="background:green;padding:5px;color:white;border-radius:8px;">product stock normal</span>
                                    @endif
                                </td>
                                <td>
                                    <button  data-bs-toggle="modal" data-bs-target="#editproduct{{$products->id}}"class="btn btn-secondary">Edit</button>
                                </td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteproduct{{$products->id}}"class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                        <!-- Modal  for edit product-->
                        <div class="modal right fade" id="editproduct{{$products->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="/updateproduct/{{$products->id}}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group row">
                                                <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('product_Name') }}</label>

                                                <div class="col-md-12">
                                                    <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{$products['product_name'] }}" required autocomplete="product_name" autofocus>

                                                    @error('product_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>

                                                <div class="col-md-12">
                                                    <textarea id="description" cols="5" rows="8" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $products['description']  }}" required autocomplete="description" autofocus>{{ $products['description']  }}</textarea>

                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('brand') }}</label>

                                                <div class="col-md-12">
                                                    <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ $products['brand']  }}" required autocomplete="brand" autofocus>

                                                    @error('brand')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('price') }}</label>

                                                <div class="col-md-12">
                                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $products['price']  }}"required autocomplete="new-password">

                                                    @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('quantity') }}</label>

                                                <div class="col-md-12">
                                                    <input id="quantity" type="number" class="form-control @error('qunatity') is-invalid @enderror" name="quantity"value="{{ $products['quantity']  }}" required autocomplete="new-password">

                                                    @error('quantity')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="alert_stock" class="col-md-4 col-form-label text-md-right">{{ __('alert_stock') }}</label>

                                                <div class="col-md-12">
                                                    <input id="alert_stock" type="number" class="form-control @error('alert_stock') is-invalid @enderror" value="{{ $products['alert_stock']  }}" name="alert_stock" required autocomplete="new-password">

                                                    @error('alert_stock')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary m-2">
                                                        {{ __('Update') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                      <!-- Modal End-->

                       <!-- Modal  for delete product-->
                       <div class="modal right fade deleteModel" id="deleteproduct{{$products->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="/deleteproduct/{{$products->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="p-3">
                                                <h4>Are you want to delete {{$products->product_name}} from your products list</h4>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary m-2">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                      <!-- Modal End-->
                     @endforeach
                </table>
            </div>  <!-- End card -->
        </div>    <!-- End col-md-8 -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   <h4 class="m-3">Search Product</h4>
                </div>
                <div class="card-body d-flex">
                    <input type="text" placeholder="search user">
                    <button class="btn btn-primary m-2" >Search</button>
                </div>
            </div>
        </div> <!-- End col-md-4-->
    </div> <!-- End row -->
</div> <!-- End container -->

 <!-- Modal  for add product-->
    <div class="modal right fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD New product_product </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/saveproduct">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('product_Name') }}</label>

                            <div class="col-md-12">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autocomplete="product_name" autofocus>

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>

                            <div class="col-md-12">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('brand') }}</label>

                            <div class="col-md-12">
                                <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand" autofocus>

                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('price') }}</label>

                            <div class="col-md-12">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="new-password">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('quantity') }}</label>

                            <div class="col-md-12">
                                <input id="quantity" type="number" class="form-control @error('qunatity') is-invalid @enderror" name="quantity" required autocomplete="new-password">

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary m-2">
                                    {{ __('Add Product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
           
    <!-- Modal End-->


    <style>
        .modal.right .modal-dialog{
            position: absolute;
                 top:0px;
                 left:360px;
                 margin:0px;
                 max-width:800px;
               
        }
        .modal.right .modal-content{
            max-width:800px;
            
        }

        .deleteModel .modal-content{
            background-color:red;   
             color:white;
        }
    </style>

@endsection