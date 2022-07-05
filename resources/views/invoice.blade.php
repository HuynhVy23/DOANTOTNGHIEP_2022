@extends('layout.layout')
@section('main')
    <div class="page-heading about-heading header-text" style="background-image: url(../images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Wellcome to</h4>
              <h2>Your bill list</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products call-to-action">
      <div class="container">
        @if($errors->any())
          @error('success')
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @enderror
          @endif
          @if(count($invoice)<1)
          <div class="col-12" style="text-align: center">
               <h1 style="color: #dd2b0b">Oops...</h1>
               <br>
               <h6>Your order is empty.Let's continue shopping.</h6>
               <br>
               <a href="{{ route('product') }}" class="btn btn-info btn-rounded">Continue shopping</a>
          </div>
          @else
          <div class="col-12">
               <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach ( $invoice as $inv)
                              <tr>     
                              <td>{{ $inv->id }}</td>
                              <td>{{ $inv->shipping_address }}</td>
                              <td>{{ $inv->shipping_phone }}</td>
                              <td>{{ $date[$inv->id] }}</td>
                              <td style="color: #FFA500">{{ $status[$inv->id] }}</td>
                              <td><a href="{{ route('invoice.show',$inv->id) }}" class="btn btn-info btn-rounded">
                                   Detail</a></td>
                            
                            <td>
                              @if ($inv->status==2)<a href="{{ route('review.show',$inv->id) }}" class="btn btn-info btn-rounded">
                              Review</a>
                              @endif</td>
                              
                            
                           </tr>
                           @endforeach  
                             </tbody>
                    </table>
            </div>
          </div>
        @endif
      </div>
    </div>

  @stop
