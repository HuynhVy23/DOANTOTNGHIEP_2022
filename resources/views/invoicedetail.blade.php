@extends('layout.layout')
@section('main')
    <div class="page-heading about-heading header-text" style="background-image: url(../images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Invoice Detail</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products call-to-action">
      <div class="container">
          <div class="col-12">
            <h6>Id invoice : {{ $invoice->id }}</h6><br>
            <div class="inv">
            <p>Shipping Address : {{ $invoice->shipping_address }}</p><br>
            <p>Shipping Phone : {{ $invoice->shipping_phone }}</p><br>
            <p>Date payment : {{ $detail[1] }}</p><br>
        </div>
               <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Capacity</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub-total</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach ( $invoicedetail as $inv)
                              <tr>
                                <td><img src="{{ $inv->image }}" alt="" width="100px" height="100px"></td>     
                              <td>{{ $inv->name }}</td>
                              <td>{{ $inv->capacity }}</td>
                              <td>{{ $inv->quantity }}</td>
                              <td>{{ number_format( $inv->price , 0, ',', '.') . " VND" }}</td>
                              <td>{{ number_format( $inv->price*$inv->quantity , 0, ',', '.') . " VND" }}</td>
                           </tr>
                           @endforeach  
                             </tbody>
                    </table>
            </div>
          </div>
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
            <li class="list-group-item">
                <div class="row">
                      <div class="col-6">
                           <em>Status</em>
                      </div>
                      
                      <div class="col-6 text-right">
                           <strong style="color:#FFA500">{{ $invoice->status }}</strong>
                      </div>
                 </div>
              </li>
              @if ($invoice->status=="Waiting for confirmation")
              <li  class="list-group-item">
                <div style="text-align: center;">
                <a href="{{ route('invoicecancel',$invoice->id) }} " class="btn btn-danger btn-rounded">Cancel order</a></div>
              </li>
              @endif
              {{-- @if ($detail[0]==2)
              <li  class="list-group-item">
                <div style="text-align: center;">
                <a href="{{ route('invoicereview',$invoice->id) }} " class="btn btn-info btn-rounded">Review</a></div>
              </li>
              @endif --}}
          </ul>
      </div>
    </div>

  @stop