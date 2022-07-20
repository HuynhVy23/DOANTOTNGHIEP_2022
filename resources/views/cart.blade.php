@extends('layout.layout')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-heading about-heading header-text" style="background-image: url(../images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Wellcome to</h4>
              <h2>Cart Hi</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products call-to-action">
      <div class="container">
          @if($errors->any())
          @error('success')
          <div class="col-12" style="text-align: center">
               <h1 style="color: #17a2b8">Thank you</h1>
               <br>
               <h6>Your order is being processed by us. Thank you for buying from us.</h6>
               <br>
               <a href="{{ route('product') }}" class="btn btn-info btn-rounded">Continue shopping</a>
          </div>
          @enderror
          @else
          @if(count($product)<1)
          <div class="col-12" style="text-align: center">
               <h1 style="color: #dd2b0b">Oops...</h1>
               <br>
               <h6>Your cart is empty, please add products to your cart.</h6>
               <br>
               <a href="{{ route('product') }}" class="btn btn-info btn-rounded">Continue shopping</a>
          </div>
          @else
          <div class="col-12">
               <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th></th>
                                <th>Name</th>
                                <th>Capacity</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                         <form action="{{ route('invoice.store') }}" method="POST">
                              @csrf
                              @foreach ( $product as $pd)
                              <tr id="cart{{ $pd->cart }}">   
                                   <td><img src="{{ $pd->image }}" alt="" width="100px" height="100px"></td>   
                              <td>{{ $pd->name }}</td>
                              <td>{{ $pd->capacity }}</td>
                              <td><div class="form-group"><input id="quantity{{ $pd->id }}" name="quantity{{ $pd->id }}" class="form-control"  style="width:70px;" type="number" min="1" max="{{ $pd->stock }}" value="{{ $pd->quantity }}" onchange="cartquantity({{ $pd->id }})"></div></td>
                             <td>{{ $pd->stock }}</td>
                              <td>{{ number_format( $pd->price , 0, ',', '.') . " VND" }}<input type="hidden" value="{{ $pd->price }} " id="price{{ $pd->id }}"></td>
                              <td><p id="total{{ $pd->id }}" style="color: #212529;font-size:15px;font-weight:400"> {{ number_format( $pd->price*$pd->quantity , 0, ',', '.') . " VND" }}</p><input type="hidden" value="{{ $pd->price*$pd->quantity }}" id="ttotal{{ $pd->id }}" class="total"></td>
                              {{-- <td><a href="{{ route('cartdelete',$pd->cart) }}" class="btn btn-danger btn-rounded">
                                <i class="fa fa-trash"></i></a></td> --}}
                                   <td><button type="button" class="btn btn-danger btn-rounded btn-deletecart" onclick="deletecart({{ $pd->cart }})"><i class="fa fa-trash"></i></button></td>
                           </tr>
                           @endforeach  
                             </tbody>
                    </table>
            </div>
          </div>
          <input type="hidden" name="totalproduct" id="totalproduct" value="{{ count($product) }}">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="row">
                  <div class="col-6">
                       <em>Total Bill</em>
                  </div>
                  
                  <div class="col-6 text-right">
                       <strong id="total">{{ number_format( $total , 0, ',', '.') . " VND" }}</strong>
                  </div>
             </div>
          </li>
          
          
        </ul>

        <br>
        
        <div class="inner-content">
          <div class="contact-form">
              
                   <div class="row">
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Phone:</label>
                                  <input type="text" class="form-control" name="phone" value="{{ $user->phone }} "onkeypress='return event.charCode>=48 && event.charCode<=57'>
                             </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                         <div class="form-group">
                              <label class="control-label">Address :</label>
                              <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                         </div>
                    </div>
                   </div>

                   <div class="row">
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Payment method</label>
                                  <input type="text" name="payment" class="form-control" value="Cash payment" readonly>
                                  {{-- <select class="form-control">
                                       <option value="bank">Bank account</option>
                                       <option value="cash">Cash</option>
                                       <option value="paypal">PayPal</option>
                                  </select> --}}
                             </div>
                        </div>
                   </div>

                   {{-- <div class="form-group">
                        <label class="control-label">
                             <input type="checkbox">

                             I agree with the <a href="terms.html" target="_blank">Terms &amp; Conditions</a>
                        </label>
                   </div> --}}

                   <div class="clearfix">
                        <button type="submit" class="filled-button pull-right" id="checkout" onclick="checkout()">Checkout</button>
                   </div>
              </form>
          </div>
        </div>
        @endif
        @if(count($soldout)>0)
        <h2 style="text-align: center">Sold out</h2>
        <table class="table table-striped" style="opacity: 0.5;">
          <thead>
              <tr>
                <th></th>
                  <th>Name</th>
                  <th>Capacity</th>
                  <th>Quantity</th>
                  <th>Stock</th>
                  <th>Price</th>
                  <th>Total</th>
              </tr>
          </thead>
          <tbody>
            @foreach ( $soldout as $pd)
            <tr >   
              <td><img src="{{ $pd->image }}" alt="" width="100px" height="100px"></td>   
         <td>{{ $pd->name }}</td>
         <td>{{ $pd->capacity }}</td>
         <td><div class="form-group"><input id="quantity{{ $pd->id }}" name="quantity{{ $pd->id }}" class="form-control"  style="width:70px;" type="number" min="1" max="{{ $pd->stock }}" value="{{ $pd->quantity }}" onchange="cartquantity({{ $pd->id }})"></div></td>
        <td>{{ $pd->stock }}</td>
         <td>{{ number_format( $pd->price , 0, ',', '.') . " VND" }}<input type="hidden" value="{{ $pd->price }} " id="price{{ $pd->id }}"></td>
         <td><p id="total{{ $pd->id }}" style="color: #212529;font-size:15px;font-weight:400"> {{ number_format( $pd->price*$pd->quantity , 0, ',', '.') . " VND" }}</p><input type="hidden" value="{{ $pd->price*$pd->quantity }}" id="ttotal{{ $pd->id }}" class="total"></td>
         <td><a href="{{ route('cartdelete',$pd->cart) }}" class="btn btn-danger btn-rounded">
          <i class="fa fa-trash"></i></a></td>
         </tr>
            @endforeach  
        </tbody>
        </table>
        @endif
        @endif
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Book Now</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contact-form">
              <form action="#" id="contact">
                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Pick-up location" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Return location" required="">
                          </fieldset>
                       </div>
                  </div>

                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Pick-up date/time" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Return date/time" required="">
                          </fieldset>
                       </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Enter full name" required="">

                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter email address" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter phone" required="">
                          </fieldset>
                       </div>
                  </div>
              </form>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Book Now</button>
          </div>
        </div>
      </div>
    </div>


  @stop
