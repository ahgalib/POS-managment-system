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
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th><button class="btn btn-sm btn-success add-more"style="font-weight:bold;font-size:20px;">+</button></th>
                        </tr>
                    </thead>
                    <tbody class="addMoreProduct">
                        <tr>
                            <td>1</td>
                            <td>
                                <select name="product_id[]" id="product_id" class="form-control product_id">
                                    <option value="">Select your product</option>
                                    @foreach($product as $products)
                                        <option data-price="{{$products->price}}" value="{{$products->id}}">{{$products->product_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="qunatity[]"  id="qunatity" class="form-control qunatity">
                            </td>
                            <td>
                                <input type="number" name="price[]"  id="price" class="form-control price">
                            </td>
                            <td>
                                <input type="number" name="discount[]"  id="discount" class="form-control discount">
                            </td>
                            <td>
                                <input type="number" name="total_amount[]"  id="total" class="form-control total_amount">
                            </td>
                            <td>
                                <a  class="btn btn-sm btn-danger"style="font-weight:bold;font-size:20px;">-</a>
                            </td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>  <!-- End card -->
        </div>    <!-- End col-md-8 -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   <h4 class="m-3"><b class="total">0.00</b></h4>
                </div>
                <div class="card-body d-flex">
                    <input type="text" placeholder="search user">
                    <button class="btn btn-primary m-2" >Search</button>
                </div>
            </div>
        </div> <!-- End col-md-4-->
    </div> <!-- End row -->
</div> <!-- End container -->



@endsection


@section('script')
<script>
    $(document).ready(function(){
        $('.add-more').click(function(){
            var closebtn = "-";
            var product = $('.product_id').html();
            var numberOfRow = ($('.addMoreProduct tr').length - 0 ) + 1;
            var tr = '<tr>'
                        +'<td class="no">'+numberOfRow+'</td>'
                        +'<td><select name="product_id[]" class="form-control product_id">'+ product +'</select></td>'
                        +'<td><input type="number" class="form-control quantity" name="quantity[]"></td>'
                        +'<td><input type="number" class="form-control price" name="price[]"></td>'
                        +'<td><input type="number" class="form-control discount" name="discount[]"></td>'
                        +'<td><input type="number" class="form-control total_amount" name="total_amount[]"></td>'
                        +'<td><a class="btn btn-danger btn-sm delete ">'+closebtn+'</a></td>'
                    +'</tr>'
                    $('.addMoreProduct').append(tr);
        })
        //DELETE tr
        $('.addMoreProduct').delegate('.delete','click',function(){
            $(this).parent().parent().remove();
        })

        //For total amount
        function total_amount(){
            var total = 0;
            $('.total_amount').each(function(i,e){
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').html(total);

        }
        $('.addMoreProduct').delegate('.product_id','change',function(){
            var tr = $(this).parent().parent();
            var price = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(price);
            var qty = tr.find('.quantity').val()-0;
            var dis = tr.find('.discount').val()-0;
            var price = tr.find('.price').val()-0;
            var total_amount = (qty * price) - ((qty * price * dis)/100);
            tr.find('.total_amount').val(total_amount);

        })
    })
</script>

@endsection
